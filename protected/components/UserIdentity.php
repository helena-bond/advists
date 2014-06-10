<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * 
     * @return boolean whether authentication succeeds.
     */
    private $_id; 

    public function authenticate() {
        // Производим аутентификацию ID.UZ пользователя
        $user = Member::model()->find('LOWER(Identity)=?', array(strtolower($this->username)));
        if (($user === null)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else { 
            $this->username = $user->Identity;
            $this->_id = $user->EnrollNumber;
            
            if(!$user->save())
            {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
            else
            {
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }
    
}
