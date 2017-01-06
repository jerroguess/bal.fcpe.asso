<?PHP

/*
--------------------------------------------------------------------
class.bo.front.controller.php
--------------------------------------------------------------------
Creator : X.ROUILLY 10/02/2015
--------------------------------------------------------------------
(c) 2013. All Rights Reserved.  FCPE
--------------------------------------------------------------------
*/

    abstract class boFrontController
    {
        public static function dispatch()
        {
            try
            {
                $request = new boRequest();
                $response = new boResponse();
                boActionController::process($request, $response)->printOut();
            }
            catch(boCoreException $e)
            {
                echo $e;
                boActionController::processException($request, $response, $e)->printOut();
            }
        }
    }
    
?>