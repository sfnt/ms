<?php  
  
/** 
 * UserIdentity represents the data needed to identity a user. 
 * It contains the authentication method that checks if the provided 
 * data can identity the user. 
 */  
class ManagerIdentity extends CUserIdentity  
{  
    /** 
     * Authenticates a user. 
     * The example implementation makes sure if the username and password 
     * are both 'demo'. 
     * In practical applications, this should be changed to authenticate 
     * against some persistent user identity storage (e.g. database). 
     * @return boolean whether authentication succeeds. 
     */  

	const ERROR_USERNAME_ISBLOCK = 67;
    private $_id;
    private $_user;
    public function authenticate()
    {
		//指定时间内错误登陆次数不能超过指定次数，否则禁止登录。
		$usertype = EnumHelper::UserType();
		$logintime = time()-Yii::app()->params['errloginblocktime'];
		$sql = "SELECT COUNT(*) AS cnt FROM ".Blocklist::model()->tableName()." WHERE username = '".$this->username."' AND usertype = '".$usertype['BACKEND']."' AND logintime > ".$logintime;
		$count=Yii::app()->db->createCommand($sql)->queryScalar();

		if ($count>=Yii::app()->params['errlogintime']) {
			$this->errorCode = self::ERROR_USERNAME_ISBLOCK;
		} else {
			$user = Manager::model()->findByAttributes(array('username' => $this->username,'status'=>1));

			if ($user === null) {
				$this->errorCode = self::ERROR_USERNAME_INVALID;
			} else {
				if ($user->password !== UtilHelper::encryptPwd($this->password, $user->salt)) {
					$this->errorCode = self::ERROR_PASSWORD_INVALID;
				} else {
					$this->_id = $user->id;
					if (null === $user->lastlogintime) {
						$lastLogin = time();
					} else {
						$lastLogin = $user->lastlogintime;
					}
					$this->setState('lastLoginTime', $lastLogin);
                    $user->lastlogintime = time();
                    $user->lastloginip = UtilHelper::getOnlineIP();
                    $user->save();
					//$this->setState('isadmin', $user->isadmin);
                    $this->_user = $user;
					$this->errorCode = self::ERROR_NONE;
				}
			}
		}
        //unset($user);  
        return !$this->errorCode;  
    }
  
    public function getId()  
    {  
        return $this->_id;  
    }  
    public function getUser() {
		return $this->_user;
	}
}  