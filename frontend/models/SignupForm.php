<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Persona;
use common\models\SPNewUserParams;
use Exception;
use Faker\Provider\ar_EG\Person;
use yii\debug\models\search\Log;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    /* VIC COMPLEMENTS */
    public $nombre;
    public $apellidoP;
    public $apellidoM;

 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        
            ['nombre', 'required'],
            ['nombre', 'string', 'max' => 255],

            ['apellidoP', 'required'],
            ['apellidoP', 'string', 'max' => 255 /* (new Persona)->getValidators()[1]->max */],
            
           /*  ['apellidoM', 'required'], */
            ['apellidoM', 'string', 'max' => 255 ],

        
        ];
    }

    public function attributeLabels()
    {    
        return array(

            'nombre' => 'Nombre',
            'apellidoP' => 'Apellido Paterno',
            'apellidoM' => 'Apellido Materno',
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
    
        );
    
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        /* if (!$this->validate()) {
            return null;
        } */
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $newUser = new SPNewUserParams();
        $newUser->username = $user->username;
        $newUser->email = $user->email;

        $newUser->auth_key = $user->auth_key;
        $newUser->password_hash = $user->password_hash;;
        $newUser->password_reset_token = $user->password_reset_token;
        //$newUser->verification_token = $user->verification_token;

        $newUser->nombre = $this->nombre ;
        $newUser->apellidoP = $this->apellidoP;
        $newUser->apellidoM = $this->apellidoM;


        /* SE PUEDE HACER ASI POR PARTES; pero mejor uso el SP */
      /*   $datosPersona = new Persona();
        $datosPersona->apellidoP =  $this->apellidoP;
        $datosPersona->nombre =      $this->nombre  ;
        $datosPersona->apellidoM =  $this->apellidoM; */

        

        return  $this->createUser($newUser) > 0/*  && $this->sendEmail($newUser) */;
        /* $user->save() */  
       
    }
 
     /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function createUser($newUser){

        $sql ="EXEC sp_create_user :username,:email,:password_hash,:auth_key,:password_reset_token ,:verification_token,:nombre,:apellidoP,:apellidoM";
        $params =[
                ':username'=>$newUser->username,
                ':email'=>$newUser->email,
                ':password_hash'=>$newUser->password_hash,
                ':auth_key'=>$newUser->auth_key,
                ':password_reset_token'=>$newUser->password_reset_token,
                ':verification_token'=>$newUser->verification_token,
                ':nombre'=>$newUser->nombre,
                ':apellidoP'=>$newUser->apellidoP,
                ':apellidoM'=>$newUser->apellidoM
        ];
        $sql2 = "EXEC sduma.dbo.testSP :vicParam";
        $val = "ALV";
        $params2 =[
            ':vicParam'=> $val
        ];
        /* ->bindValue(':username',$newUser->username)
        ->bindValue(':email',$newUser->email)
        ->bindValue(':password_hash',$newUser->password_hash)
        ->bindValue(':auth_key',$newUser->auth_key)
        ->bindValue(':password_reset_token',$newUser->password_reset_token)
        ->bindValue(':verification_token',$newUser->verification_token)
        ->bindValue(':nombre',$newUser->nombre)
        ->bindValue(':apellidoP',$newUser->apellidoP)
        ->bindValue(':apellidoM',$newUser->apellidoM); */
        $res = -1;
        try{
            $res =  Yii::$app->db->createCommand($sql, $params)->execute( );

        }
        catch(Exception $ex){
            Yii::info($ex, $category = 'DBBB');

        }
        Yii::info($res, $category = 'DB ACTION');
        return $res;
         /* yii\log\Logger::get */
         /* Yii::getLogger()->info */
        
       /*  $result = \Yii::$app->db->createCommand("CALL storedProcedureName(:paramName1, :paramName2)") 
        ->bindValue(':paramName1' , $param1 )
        ->bindValue(':paramName2', $param2)
        ->execute(); */
        

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
