# 				Yii2 Follow



<center>User follow unfollow system for Laravel.</center>

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fkayw-geek%2Fyii2-follow.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fkayw-geek%2Fyii2-follow?ref=badge_shield) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/kayw-geek/yii2-follow) ![GitHub](https://img.shields.io/github/license/kayw-geek/yii2-follow) 

## Installing

```
$ composer require kayw-geek/yii2-follow
```

### Migrations

This step is also optional, if you want to custom the pivot table, you can publish the migration files:

```
$ yii migrate/up --migrationPath=@vendor/kayw-geek/yii2-follow/migrations
```

## Usage

### Traits

#### kaywGeek\Follow\FollowerTrait

```php
use kaywGeek\follow\FollowerTrait;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    <...>
    use FollowerTrait;
    <...>
}
```

### API

```php
$user1 = User::find(1);
$user2 = User::find(2);

$user1->follow($user2);
$user1->unfollow($user2);
$user1->checkFollowed($user2);
$user1->followedCount();
$user1->followerCount();
```

#### Get followings:

```php
$user->followings;
```

#### Get followers:

```php
$user->followers;
```

### Aggregations

```php
// with query where
$user->followings()->where(['<',['follow_at'=>date('Y-m-d')]])->all();

// followers orderBy
$post->followers()->orderBy('follow_at desc');
```

# License

