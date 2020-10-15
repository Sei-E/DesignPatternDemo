<?php
interface StateInterface
{
    public function greet();
    public function saySomething();
}

class NormalState implements StateInterface
{
    public function greet()
    {
        echo 'おつかれー。';
    }

    public function saySomething()
    {
        echo 'いい天気だね。';
    }
}

class HappyState implements StateInterface
{
    public function greet()
    {
        echo 'おつかれ！';
    }

    public function saySomething()
    {
        echo '今日も頑張ろう！';
    }
}

class SadState implements StateInterface
{
    public function greet()
    {
        echo '...おつかれさまです。';
    }

    public function saySomething()
    {
        echo '......';
    }
}


class MyFriend
{
    private $feelingState = null;

    public function changeState(StateInterface $state)
    {
        $this->feelingState = $state;
    }

    public function greet()
    {
        $this->feelingState->greet();
    }

    public function saySomething()
    {
        $this->feelingState->saySomething();
    }
}

$myFriend = new MyFriend();
$myFriend->changeState(new NormalState);


echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();

// なにかいいことが起きる
$myFriend->changeState(new HappyState);

echo '<p>一時間後</p>';
echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();

// なにか悪いことが起きる
$myFriend->changeState(new SadState);

echo '<p>二時間後</p>';
echo '>>>おつかれー<br>';
$myFriend->greet();
$myFriend->saySomething();