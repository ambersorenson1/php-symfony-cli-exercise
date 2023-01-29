<?php

namespace App\Cli;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application("PHP Symfony CLI", "v0.0.1");

$application->add(new EchoNameCommand());
$application->add(new SendMessageCommand());
$application->add(new SlackCommand());
$application->add(new ListUsersCommand());
$application->add(new ListTemplatesCommand());
$application->add(new AddUserCommand());
$application->add(new DeleteUserCommand());
$application->add(new UpdateTemplateCommand());
$application->add(new DeleteTemplateCommand());
$application->add(new AddTemplateCommand());
$application->add(new ShowSentMessagesCommand());
//$application->add(new ListUsersByFiveCommand());




try {
    $application->run();
} catch (\Exception $e) {}
