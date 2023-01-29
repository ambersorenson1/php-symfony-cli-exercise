<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('delete-user')
            ->setDescription('Delete a user from the JSON file')
            ->addArgument('userId', InputArgument::REQUIRED, 'The userId of the user you want to delete');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $userId = $input->getArgument('userId');
        $usersJsonFile = 'src/data/users.json';
        $users = json_decode(file_get_contents($usersJsonFile), true);
        //  This is removing all elements from the array $users which have an 'id' key with a value equal to variable $userId and store it in $newUsers variable
        $newUsers = array_filter($users, function ($user) use($userId){
            return $user['userId'] != $userId;
        });
        file_put_contents($usersJsonFile, json_encode($newUsers, JSON_PRETTY_PRINT));

        $output->writeln('User deleted successfully');
        return Command::SUCCESS;
    }
}