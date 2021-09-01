<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Journey;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller {

    /**
     * Creates a link entry
     * @param Request $request
     * @return json
     */
    public function createLink(Request $request) {
        $validator = Validator::make($request->all(), [
                    'link' => 'required',
                    'link_type' => 'required',
                    'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 400);
        } else {
            $link = new Link;
            $link->link = $request->link;
            $link->link_type = $request->link_type;
            $link->user_id = $request->user_id;
            $link->save();

            Journey::where('user_id', $link->user_id)->delete();
            $journey = $this->getCustomerJourney($link->user_id);
            Journey::create(['user_id' => $link->user_id, 'links' => json_encode($journey)]);

            return response()->json(["message" => "Link record created"], 201);
        }
    }

    /**
     * Hits received by a link in a provided time interval
     * @return json
     */
    public function linkHitsPerInterval() {
        if (!request('link') || !request('from') || !request('to'))
            return response()->json(["message" => 'Please provide link, from and to!'], 400);

        $links = Link::where('link', request('link'))->whereBetween('created_at', [request('from'), request('to')])->get()->toArray();

        return response()->json($links, 200);
    }

    /**
     * Hits received by a each page type in a provided time interval
     * @return json
     */
    public function pageTypeHitsPerInterval() {
        if (!request('from') || !request('to'))
            return response()->json(["message" => 'Please provide from and to!'], 400);

        $links = Link::groupBy('link_type')->select('link_type', DB::raw('count(*) as total'))->whereBetween('created_at', [request('from'), request('to')])->get()->toArray();

        return response()->json($links, 200);
    }

    /**
     * Customer journey.
     * @return json
     */
    public function customerJourney() {
        if (!request('user_id'))
            return response()->json(["message" => 'Please provide user_id!'], 400);

        $links = $this->getCustomerJourney(request('user_id'));

        return response()->json($links, 200);
    }

    /**
     * Same customer journey.
     * @return json
     */
    public function sameCustomerJourney() {
        if (!request('user_id'))
            return response()->json(["message" => 'Please provide user_id!'], 400);

        $journey = Journey::select('links')->where('user_id', request('user_id'))->get()->first();
        if ($journey) {
            $journeys = Journey::where('links', $journey->links)->where('user_id', '!=', request('user_id'))->get()->toArray();
            if ($journeys)
                return response()->json($journeys, 200);
            else
                return response()->json(["message" => 'No similar journies!'], 404);
        } else {
            return response()->json(["message" => 'No journey for this customer!'], 404);
        }
    }

    /**
     * Gets the customer journey
     * @param int $user_id
     * @return array
     */
    private function getCustomerJourney($user_id) {
        $links = Link::select('link')->where('user_id', $user_id)->orderBy('created_at', 'ASC')->get()->toArray();
        return $links;
    }

}
