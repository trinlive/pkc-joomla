<?php
/*
 * Copyright (C) 2017 KAINOTOMO PH LTD <info@kainotomo.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;
?>


<form action="<?php echo JRoute::_('index.php?option=com_sptransfer&view=cpanel'); ?>" method="post" name="adminForm" id="adminForm">        
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if ($this->DbConnection) {
                            echo '<p class="alert alert-success">' . Text::_('COM_SPTRANSFER_MSG_SUCCESS_CONNECTION') . '</p>';
                    } else {
                            echo '<p class="alert alert-danger">' . Text::sprintf('COM_SPTRANSFER_MSG_ERROR_CONNECTION_DB', DatabaseHelper::$exc->getCode(), DatabaseHelper::$exc->getMessage()) . '</p>';
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if ($this->FtpConnection) {
                            echo '<p class="alert alert-success">' . Text::_('COM_SPTRANSFER_MSG_SUCCESS_FTP_CONNECTION') . '</p>';
                    } else {
                            echo '<p class="alert alert-danger">' . Text::sprintf('COM_SPTRANSFER_MSG_ERROR_CONNECTION_FTP', FtpHelper::$exc->getCode(), FtpHelper::$exc->getMessage()) . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="card-body">

                    <p>Before proceeding with transfer use above buttons to test connections.</p>
                    <p>The database connection is necessary for transferring the data, and FTP for the files.</p>
                    <p>It is also strongly suggested to read the product's <a href="https://www.kainotomo.com/products/sp-transfer/documentation" target="blank">documentation</a>, and more specific <a href="https://www.kainotomo.com/products/sp-transfer/documentation/migrate-old-site-to-joomla-version-3-x" target="blank">the whole process step-by-step</a>.</p>
                    <p>
                        If you are having trouble connecting, probably below FAQs will help you:
                    <ul>
                        <li><a href="https://www.kainotomo.com/products/sp-upgrade/documentation/faq/how-to-connect-to-the-source-database" target="blank">How to connect to the source database?</a></li>
                        <li><a href="https://www.kainotomo.com/products/sp-upgrade/documentation/faq/why-i-cannot-connect-ftp" target="blank">Why I cannot connect FTP?</a></li>
                    </ul>
                    </p>
                    <p><mark><?php echo Text::_('COM_SPTRANSFER_BACKUP'); ?></mark></p>
                    <input type="hidden" name="task" value="">
                    <input type="hidden" name="boxchecked" value="0">
                    <?php echo JHtml::_('form.token'); ?>
                </div>   
            </div>
            <div class="row card-footer small">
                <?php
                $manifest = SptransferHelper::getManifest('com_sptransfer');
                echo Text::_($manifest->get('name')) . ' ' . $manifest->get('version');
                ?>
            </div>
        </div>
    </div>    
</form>
