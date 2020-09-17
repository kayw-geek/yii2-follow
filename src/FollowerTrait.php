<?php
/**
 * Created by PhpStorm.
 * @name:
 * @author: weikai
 * @date: dt
 */
namespace kaywGeek\follow;


use yii\base\Exception;
use yii\base\Model;

trait FollowerTrait
{

    /**
     * @param $user
     * @return string
     * @name:关注
     * @author: weikai
     * @date: 20.7.22 14:29
     */
    public function follow( Model $user ) :bool 
    {
        if (!$user instanceof Model || empty($this->id)){
            throw  new Exception('User Model Error');
        }

        if (!self::checkFollowed($user)){
            return false;
        }

        return self::run([
            'user_id'=>$user->id,
            'follower_id'=>$this->id,
            'follow_at'=>date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @param $user
     * @return bool
     * @name:取消关注
     * @author: weikai
     * @date: 20.7.22 15:13
     */
    public function unfollow( Model $user ) :bool
    {
        if (!$user instanceof Model || empty($this->id)){
            throw  new Exception('User Model Error');
        }

        if (self::checkFollowed($user)){
            return false;
        }

        try{
            if (!$this->getModel($user)){
                return false;
          }
            return $this->getModel($user)->delete() ? true : false;
        }catch (\Exception $exception){
            \Yii::error($exception->getMessage(),__METHOD__);
            return false;
        }

    }

    /**
     * @param $user
     * @return bool|Follower|null
     * @throws Exception
     * @name:获取model
     * @author: weikai
     * @date: 20.9.17 14:07
     */
    public function getModel( Model $user )
    {
        if (!$user instanceof Model || empty($this->id)){
            throw  new Exception('User Model Error');
        }
        return empty(Follower::findOne(['user_id'=>$this->id,'follower_id'=>$user->id])) ? false : Follower::findOne(['user_id'=>$this->id,'follower_id'=>$user->id]);
    }

    /**
     * @return bool
     * @name:已关注一对多关联
     * @author: weikai
     * @date: 20.7.22 15:41
     */
    public function followers( )
    {
        return $this->hasMany(Follower::className(),['follower_id'=>'id']);
    }

    /**
     * @return mixed
     * @name:粉丝一对多关联
     * @author: weikai
     * @date: 20.9.17 14:18
     */
    public function followings( )
    {
        return $this->hasMany(Follower::className(),['user_id'=>'id']);
    }

    /**
     * @param $user_id
     * @return mixed
     * @name:粉丝数量
     * @author: weikai
     * @date: 20.8.3 17:18
     */
    public function followerCount( )
    {
        return intval($this->followings()->count());

    }

    /**
     * @param $user_id
     * @return mixed
     * @name:关注数量
     * @author: weikai
     * @date: 20.8.3 17:20
     */
    public function followedCount(  )
    {
        return intval($this->followeds()->count());;
    }

    /**
     * @param $user
     * @return bool
     * @name:检查是否已关注此用户
     * @author: weikai
     * @date: 20.7.22 15:03
     */
    public function checkFollowed(Model $user ) :bool
    {
        return empty(Follower::findOne(['user_id'=>$user->id,'follower_id'=>$this->id])) ? true : false;
    }
    

    /**
     * @param array $value
     * @return string
     * @name:执行数据保存
     * @author: weikai
     * @date: 20.7.22 14:27
     */
    private function run( array $value )
    {
        try{
            $model = new Follower();
            $model->attributes = $value;
            if (!$model->validate()){
                \Yii::info($model->errors,__METHOD__);
                return false;
            }
            return $model->save();
        }catch (\Exception $exception){
            \Yii::info($exception->getMessage(),__METHOD__);
            return false;
        }
    }

}