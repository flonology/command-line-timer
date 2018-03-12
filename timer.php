#!/usr/bin/php
<?php
const DEFAULT_TIME_MINUTES = 30;

function getMinutesFromArguments($arguments)
{
  if (false === isset($arguments[1])) {
    return DEFAULT_TIME_MINUTES;
  }

  return intval($arguments[1]);
}

function printMinutesLeft($seconds)
{
  if ($seconds % 60 == 0) {
    $minutes = $seconds / 60;
    echo "{$minutes} minutes left ";
  }
}

function tick()
{
  echo '.';
  sleep(1);
}

function displayDoneMessage()
{
  $os = php_uname('s');
  $breakMessage = 'Rrrrring! Take a break :-)';

  if ($os == 'Darwin') {
    $command
      = 'osascript -e \'display notification "' . $breakMessage . '" with title "Break"\'';
  } else {
    $command = 'notify-send "' . $breakMessage . '"';
  }

  shell_exec($command);
}

$seconds = getMinutesFromArguments($argv) * 60;

while ($seconds > 0) {
  printMinutesLeft($seconds);
  tick();
  $seconds -= 1;
}

displayDoneMessage();
echo "Rrrrring!" . PHP_EOL;
