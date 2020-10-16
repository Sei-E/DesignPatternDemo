<?php

class MyFriend
{
    const NORMAL_FEELING = '01';
    const HAPPY_FEELING = '02';
    const SAD_FEELING = '03';

    private $feeling = null;

    public function changeState($feeling)
    {
        $this->feeling = $feeling;
    }

    public function greet()
    {
        if ($this->feeling == self::NORMAL_FEELING) {
            echo  'おつかれー。';
        } elseif ($this->feeling == self::HAPPY_FEELING) {
            echo 'おつかれ！';
        } elseif ($this->feeling == self::SAD_FEELING) {
            echo '...お疲れさまです。';
        } else {
            echo '';
        }
    }

    public function saySomething()
    {
        if ($this->feeling == self::NORMAL_FEELING) {
            echo  'いい天気だね。';
        } elseif ($this->feeling == self::HAPPY_FEELING) {
            echo '今日も頑張ろう！';
        } elseif ($this->feeling == self::SAD_FEELING) {
            echo '......';
        } else {
            echo '';
        }
    }
}

////////////////////////////////////////////////////////////////

$myFriend = new MyFriend();
$myFriend->changeState('01');


echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();

// なにかいいことが起きる
$myFriend->changeState('02');

echo '<p>一時間後</p>';
echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();

// なにか悪いことが起きる
$myFriend->changeState('03');

echo '<p>二時間後</p>';
echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();