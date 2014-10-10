<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function init()
        {
            parent::init();

            register_shutdown_function(array($this, 'onShutdownHandler'));

            if ($error = Yii::app()->errorHandler->error)
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                        json_encode(array(
                            'Status'=>$error['code'],
                            'Message'=>$error['message']
                        ));

                        Yii::app()->end(true);
                }

                Yii::app()->errorHandler->errorAction = '//site/error';
            }
        }
        
        public function onShutdownHandler()
        {
            // 1. error_get_last() returns NULL if error handled via set_error_handler
            // 2. error_get_last() returns error even if error_reporting level less then error
            $e = error_get_last();

            $errorsToHandle = E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING;

            if (!is_null($e) && ($e['type'] & $errorsToHandle))
            {
                $msg = 'Fatal error: '.$e['message'];

                // it's better to set errorAction = null to use system view "error.php" instead of run another controller/action (less possibility of additional errors)
                Yii::app()->errorHandler->errorAction = '//site/error';
                // handling error
                Yii::app()->handleError($e['type'], $msg, $e['file'], $e['line']);
            }
        }
}