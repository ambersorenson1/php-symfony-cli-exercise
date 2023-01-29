<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListUsersCommand extends Command

{
protected function configure()
{
    $this->setName('list-users')
        ->setDescription('Reads users from a JSON file and lists them in increments of 5.');
}
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonUserName = 'src/data/users.json';
        $users = json_decode(file_get_contents($jsonUserName), true);
        foreach ($users as $user) {
            $output->writeln($user['username']);
        }

        return Command::SUCCESS;
    }

}