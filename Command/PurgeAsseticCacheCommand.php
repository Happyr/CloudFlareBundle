<?php


namespace HappyR\UserProjectBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PurgeAsseticCacheCommand
 *
 * @author Tobias Nyholm
 *
 */
class PurgeAsseticCacheCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('happyr:cloudflare:purge:assetic')
            ->setDescription('Pruge the assetic cache command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cloudFlare=$this->getContainer()->get('happyr.clourflare.service.cloudflare');
        $conf=$this->getContainer()->getParameter('templating.assets_base_urls');

        var_dump($conf);
    }
}