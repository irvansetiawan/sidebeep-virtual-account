<?php
namespace Sidebeep\Service\UI\Command;

use SidebeepService\AMQPMessageAdapter\InvalidMessageException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Sidebeep\Service\UI\Command
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleCommand extends ContainerAwareCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->addArgument('event', InputArgument::REQUIRED)
            ->setName('consumer:event:name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $data = json_decode(base64_decode($input->getArgument('event')), true);

            // $adapter = new ClassAdapter();
            // $command = $adapter->getCommand($data);

            //$this->getContainer()->get('command_bus')->handle($command);
            exit(0);
        } catch (InvalidMessageException $e) {
            exit(3);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit(1);
        }
    }
}