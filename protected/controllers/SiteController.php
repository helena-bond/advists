<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest)
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            $dataProvider = ReportToday::get();
            $this->render('index', compact('dataProvider'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        
        $loid = Yii::app()->loid->load();
        if (isset($_POST['User']) and $_POST['User']['username'] === '')
        {
            Yii::app()->user->setFlash('error', Yii::t("UI", "Пожалуйста, введите свой логин на ID.UZ чтобы войти в систему"));
            unset($_POST);
        }
        if (isset($_POST['User']))
        {
            
            $username = $_POST['User']['username'];
            
            if (!preg_match('/^[a-zA-Z0-9-_]*$/', $username)) {
                  Yii::app()->user->setFlash('error', Yii::t("UI", "Пожалуйста, введите свой логин на ID.UZ чтобы войти в систему"));
                  $this->render('login', array());
                  die;
            }
            
            $pattern = '/^id.uz/';
            if (!preg_match($pattern, $username))
            {
                $username .= '.id.uz';
            }
            
            $loid->identity = $username; //Setting identifier
            $loid->required = array(
                'namePerson',
                'contact/email',
                'person/id',
            ); //Try to get info from openid provider
            $loid->realm = (!empty($_SERVER['HTTPS']) ? 'http' : 'http') . '://' . $_SERVER['HTTP_HOST'];
            $loid->returnUrl = $loid->realm . $_SERVER['REQUEST_URI']; //getting return URL
            $loid->language = Yii::app()->language;

            if (empty($err))
            {
                try {
                    $url = $loid->authUrl();
                    $this->redirect($url);
                } catch (Exception $e) {
                    $err = Yii::t('core', $e->getMessage());
                }
            }
        }

        if (!empty($_GET['openid_mode']) or !empty($_GET['openid.mode'])
                or !empty($_POST['openid.mode']) or !empty($_POST['openid_mode']))
        {
            
            if ($_GET['openid_mode'] == 'cancel')
            {
                $err = Yii::t('core', 'Authorization cancelled');
            }
            else
            {
                try {
                    if ($loid->validate())
                    {
                        $attributes = $loid->getAttributes();
                        if (Member::login($loid->identity, $attributes))
                        {
                            $this->redirect(array('site/index'));
                        }
                        else
                        {
                            $err = Yii::app()->user->getFlash('error');
                        }
                    }
                    else
                    {
                        $this->redirect(array('site/login'));
                    }
                } catch (Exception $e) {
                    $err = Yii::t('core', $e->getMessage());
                }
            }
        }
        
        if (!empty($err))
        {
            Yii::app()->user->setFlash('error', $err);
            unset($_GET);
        }

        $this->render('login', array());
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}