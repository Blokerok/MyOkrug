<?php


namespace App\UserLib;

use App\Models\Visit;

class CkeckUserIP
{



    static public function RegVisit($model,$obj)

    {

           $user_ip = request()->ip();

          $agent = request()->server('HTTP_USER_AGENT');
          $present = $obj->visit->where('user_ip','=',$user_ip);

          if (!count($present) &&  !preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $agent))
          {
              $visit = new Visit();
              $visit->visitable_id = $obj->id;
              $visit->visitable_type = $model;
              $visit->user_ip = $user_ip;
              $visit->save();
              $obj->increment('visits');

          }

    }

}




