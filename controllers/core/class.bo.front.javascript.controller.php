<?PHP

/*
  --------------------------------------------------------------------
  class.bo.front.javascript.controller.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    abstract class boFrontJavascriptController {

        public static function dispatch() {
            try {
                $request = new boRequest();
                $response = new boResponse();
                boActionJavascriptController::process($request, $response)->printOut();
            } catch (boCoreException $e) {
                boActionJavascriptController::processException($request, $response, $e)->printOut();
            }
        }
    }

?>