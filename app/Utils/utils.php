<?php

namespace App\Utils;

use DateTime;
use DB;
class Utils{
    public static function ago( $datetime ){
        $interval = date_create('now')->diff( $datetime );
        $suffix = ( $interval->invert ? ' ago' : '' );
        if ( $v = $interval->y >= 1 ) return sprintf( "%d years", $interval->y ) . $suffix;
        if ( $v = $interval->m >= 1 ) return sprintf( "%d months", $interval->m ) . $suffix;
        if ( $v = $interval->d >= 1 ) return sprintf( "%d days", $interval->d ) . $suffix;
        if ( $v = $interval->h >= 1 ) return sprintf( "%d hours", $interval->h ) . $suffix;
        if ( $v = $interval->i >= 1 ) return sprintf( "%d minutes", $interval->i ) . $suffix;
        return sprintf( "%d second", $interval->s ) . $suffix;
    }

    public static function after( $datetime ){
        $interval = date_create('now')->diff( $datetime );
        $suffix = ( $interval->invert ? ' after' : '' );
        if ( $v = $interval->y >= 1 ) return sprintf( "%d years", $interval->y ) . $suffix;
        if ( $v = $interval->m >= 1 ) return sprintf( "%d months", $interval->m ) . $suffix;
        if ( $v = $interval->d >= 1 ) return sprintf( "%d days", $interval->d ) . $suffix;
        if ( $v = $interval->h >= 1 ) return sprintf( "%d hours", $interval->h ) . $suffix;
        if ( $v = $interval->i >= 1 ) return sprintf( "%d minutes", $interval->i ) . $suffix;
        return sprintf( "%d second", $interval->s ) . $suffix;
    }

    public static function get_cityareas(){
        $cities = \App\CityArea::where('parent_id', 0)->get();

        $city_areas = array();

        foreach($cities as $city){
            $areas = \App\CityArea::where('parent_id', $city->id)->get();
            array_push($city_areas, ["id" => $city->id, "name" => $city->name, "areas" => $areas->toArray()]);
        }

        return $city_areas;
    }

    public static function ctimeformat($d){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $d), "h:i A");
    }

    public static function cdateformat2($d){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $d), "j F Y");
    }

    public static function cdateformat($d){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $d), "F j");
    }

    public static function cdateformat1($d){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $d), "Y/m/d");
    }

    public static function cdateformat3($d){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $d), "d-m-Y");
    }

    public static function ago_from_str($d) {
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $d);
        return Utils::ago($d);
    }

    public static function get_category() {
        $category=DB::table('catagories')->pluck('catagoryname', 'id');
    
        if(count($category)>0) {
          return $category;
        }
    
        else {
          return $category=['message'=>'No Category Found'];
        }
    }

    public static function categories() {
        $cat=DB::table('catagories')->get();
        return $cat;
    }

    public static function get_industrytype() {
        $get_industrytype=DB::table('industrytypes')->get();
        return $get_industrytype;
    
    }
}
