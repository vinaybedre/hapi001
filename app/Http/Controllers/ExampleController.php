<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function itemLookup($ItemId){
        
        $access_key_id = "AKIAJJ54YF5PMXSXQNRQ";
        
        $secret_key = "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";
        
        $endpoint = "webservices.amazon.in";
        
        $uri = "/onca/xml";
        
        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemLookup",
            "AWSAccessKeyId" => "AKIAJJ54YF5PMXSXQNRQ",
            "AssociateTag" => "mankho-21",
            "Available" => "Available",
            "ItemId" => $ItemId,//"B01NAKTR2H",
            "IdType" => "ASIN",
            "ResponseGroup" => "Images,ItemAttributes,Offers,Reviews"
        );
        
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }
        
        ksort($params);
        
        $pairs = array();
        
        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }
        
        $canonical_query_string = join("&", $pairs);
        
        $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
        
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));
        
        $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
        
        return $request_url;
        
        
    }
}
