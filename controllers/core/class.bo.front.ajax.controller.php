<?PHP

/*
  --------------------------------------------------------------------
  class.bo.front.ajax.controller.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    abstract class boFrontAjaxController {

        public static function dispatch() {
            try {
                $request = new boRequest();
                $response = new boResponse();
                boActionAjaxController::process($request, $response)->printOut();
            } catch (boCoreException $e) {
                boActionAjaxController::processException($request, $response, $e)->printOut();
            }
        }
    }

?>