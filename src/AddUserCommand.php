<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddUserCommand extends Command
{
    protected static $defaultName = 'add-user';

    protected function configure(): void
    {
        $this->setDescription("Adding a user to the JSON file using the prompts that are provided");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new Question('Enter the user\'s name:');

        $nameAnswer = $helper->ask($input, $output, $question);

        $idQuestion = new Question('Enter the user\'s ID:');

        $idAnswer = $helper->ask($input, $output, $idQuestion);

        $usernameQuestion = new Question('Enter the user\'s username:');

        $usernameAnswer = $helper->ask($input, $output, $usernameQuestion);

        $displayNameQuestion = new Question('Enter the user\'s display name:');

        $displayNameAnswer = $helper->ask($input, $output, $displayNameQuestion);


        $user = [
            'name' => $nameAnswer,
            'userId' => $idAnswer,
            'username' => $usernameAnswer,
            'displayName' => $displayNameAnswer
        ];

        $usersJsonFile = 'src/data/users.json';
        $users = json_decode(file_get_contents($usersJsonFile), true);

        $users[] = $user;
        file_put_contents($usersJsonFile, json_encode($users,JSON_PRETTY_PRINT));

        $output->writeln(
            "
                       Name: $nameAnswer
                       userId: $idAnswer
                       username: $usernameAnswer
                       display name: $displayNameAnswer
                       ");
        $output->writeln('User added successfully!');

        return Command::SUCCESS;
    }
}
