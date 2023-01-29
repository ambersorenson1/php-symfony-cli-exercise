<?php
//
//namespace App\Cli;
//
//
//use Symfony\Component\Console\Command\Command;
//use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Output\OutputInterface;
//use Symfony\Component\Console\Question\Question;
//
//class ListUsersByFiveCommand extends Command
//{
//    protected function configure()
//    {
//        $this->setName('slack:display-five-users')
//            ->setDescription('Displays a certain number of users from the user.json file');
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output): int
//    {
//        $continue = true;
//        $currentCount = 0;
//        $users = json_decode(file_get_contents('src/data/users.json'), true);
//
//        foreach ($users as $user) {
//            $output->writeln($user['username']);
//            while ($continue) {
//                $helper = $this->getHelper('question');
//                $question = new Question("Press 'm' to display the next 5 users, or any other letter to quit");
//                $input_char = $helper->ask($input, $output, $question);
//                if ($input_char === 'm') {
//                    while ($currentCount <= 5) {
//                        ;
//                        $output->writeln($user);
//                        $currentCount += 5;
//                    }
//                } elseif ($input_char != 'm') {
//                    $continue = false;
//                }
//            }
//
//        }
//        return Command::SUCCESS;
//    }
//}