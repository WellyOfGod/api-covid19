<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasesByStateRequest;
use App\Http\Requests\Top10StateRequest;
use App\Models\CovidCase;
use App\Services\BrasilIo\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Covid19Controller extends Controller
{
    /**
     * @param Api $brasilioApi
     */
    public function __construct(private Api $brasilioApi)
    {
        $this->brasilioApi = new Api;
    }


    /**
     * @param CasesByStateRequest $request
     * @return JsonResponse
     */
    public function casesByStateDate(CasesByStateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['date'] = now()->createFromFormat('d/m/Y',$validated['date'])->format('Y-m-d');

        $cases = $this->brasilioApi->casesByStateDate($validated['date'], $validated['state']);

        CovidCase::upsert(
            $cases['results'],
            ['date','state','city']
        );

        return response()->json(
            $cases['results'],
            201
        );
    }

    /**
     * @param Top10StateRequest $request
     * @return JsonResponse
     */
    public function top10state(Top10StateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['dateStart'] = now()->createFromFormat('d/m/Y',$validated['dateStart']);
        $validated['dateEnd'] = now()->createFromFormat('d/m/Y',$validated['dateEnd']);

        $listTop10 = CovidCase::query()
                        ->select([
                           'state','city'
                        ])
                        ->addSelect([
                            'confirmed_per_100k_inhabitants' => function($q) use($validated){
                                $q->select('confirmed_per_100k_inhabitants')
                                    ->from('covid_cases as c2')
                                    ->where('c2.state', '=', $validated['state'])
                                    ->where('c2.place_type', '=', 'city')
                                    ->whereNotNull('confirmed_per_100k_inhabitants')
                                    ->whereColumn('c2.city', '=', 'covid_cases.city')
                                    ->whereBetween('c2.date',[
                                         $validated['dateStart'],
                                         $validated['dateEnd']
                                    ])
                                    ->orderByDesc('confirmed_per_100k_inhabitants')
                                    ->limit(1);
                            }
                        ])
                        ->where('state', '=', $validated['state'])
                        ->where('place_type', '=', 'city')
                        ->whereNotNull('confirmed_per_100k_inhabitants')
                        ->whereBetween('date',[
                            $validated['dateStart'],
                            $validated['dateEnd']
                        ])
                        /* Se tiver position ele pegará a posição informada e soma +1,
                           se não, coloca por padrão 10.
                           Obs: É necessário somar porque se for passado 0 não retorna nada!
                         */
                        ->limit($validated['position'] !== null ? $validated['position'] + 1 : 10)
                        ->groupBy(['state','city','confirmed_per_100k_inhabitants'])
                        ->orderByDesc('confirmed_per_100k_inhabitants')
                        ->get();


         // Se houver posição, entra no bloco e como é index não precisa somar, o valor recebido foi passado direto no request!
        if (!empty($validated['position'])) {
            $listTop10 = $listTop10->toArray()[$validated['position']];
        }

        return response()->json(
            $listTop10
        );
    }

}
