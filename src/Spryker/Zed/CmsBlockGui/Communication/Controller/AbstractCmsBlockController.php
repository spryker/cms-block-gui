<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockGui\Communication\Controller;

use Generated\Shared\Transfer\CmsBlockTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\Kernel\Exception\Controller\InvalidIdException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @method \Spryker\Zed\CmsBlockGui\Communication\CmsBlockGuiCommunicationFactory getFactory()
 */
abstract class AbstractCmsBlockController extends AbstractController
{
    /**
     * @var string
     */
    public const URL_PARAM_ID_CMS_BLOCK = 'id-cms-block';

    /**
     * @var string
     */
    public const REDIRECT_URL_DEFAULT = '/cms-block-gui/list-block';

    /**
     * @var string
     */
    public const MESSAGE_CMS_BLOCK_INVALID_ID_ERROR = 'CMS block with provided ID doesn’t exist.';

    /**
     * @param int $idCmsBlock
     *
     * @return \Generated\Shared\Transfer\CmsBlockTransfer|null
     */
    protected function findCmsBlockById(int $idCmsBlock): ?CmsBlockTransfer
    {
        try {
            $idCmsBlock = $this->castId($idCmsBlock);
        } catch (InvalidIdException $exception) {
            return null;
        }

        $cmsBlockTransfer = $this->getFactory()
            ->getCmsBlockFacade()
            ->findCmsBlockById($idCmsBlock);

        return $cmsBlockTransfer;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function getNotFoundBlockRedirect(): RedirectResponse
    {
        $redirectUrl = Url::generate(static::REDIRECT_URL_DEFAULT)->build();

        return $this->redirectResponse($redirectUrl);
    }
}
