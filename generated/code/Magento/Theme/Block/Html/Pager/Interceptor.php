<?php
namespace Magento\Theme\Block\Html\Pager;

/**
 * Interceptor class for @see \Magento\Theme\Block\Html\Pager
 */
class Interceptor extends \Magento\Theme\Block\Html\Pager implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurrentPage');
        return $pluginInfo ? $this->___callPlugins('getCurrentPage', func_get_args(), $pluginInfo) : parent::getCurrentPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLimit');
        return $pluginInfo ? $this->___callPlugins('getLimit', func_get_args(), $pluginInfo) : parent::getLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function setLimit($limit)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLimit');
        return $pluginInfo ? $this->___callPlugins('setLimit', func_get_args(), $pluginInfo) : parent::setLimit($limit);
    }

    /**
     * {@inheritdoc}
     */
    public function setCollection($collection)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCollection');
        return $pluginInfo ? $this->___callPlugins('setCollection', func_get_args(), $pluginInfo) : parent::setCollection($collection);
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCollection');
        return $pluginInfo ? $this->___callPlugins('getCollection', func_get_args(), $pluginInfo) : parent::getCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function setPageVarName($varName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPageVarName');
        return $pluginInfo ? $this->___callPlugins('setPageVarName', func_get_args(), $pluginInfo) : parent::setPageVarName($varName);
    }

    /**
     * {@inheritdoc}
     */
    public function getPageVarName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPageVarName');
        return $pluginInfo ? $this->___callPlugins('getPageVarName', func_get_args(), $pluginInfo) : parent::getPageVarName();
    }

    /**
     * {@inheritdoc}
     */
    public function setShowPerPage($varName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setShowPerPage');
        return $pluginInfo ? $this->___callPlugins('setShowPerPage', func_get_args(), $pluginInfo) : parent::setShowPerPage($varName);
    }

    /**
     * {@inheritdoc}
     */
    public function isShowPerPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isShowPerPage');
        return $pluginInfo ? $this->___callPlugins('isShowPerPage', func_get_args(), $pluginInfo) : parent::isShowPerPage();
    }

    /**
     * {@inheritdoc}
     */
    public function setLimitVarName($varName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLimitVarName');
        return $pluginInfo ? $this->___callPlugins('setLimitVarName', func_get_args(), $pluginInfo) : parent::setLimitVarName($varName);
    }

    /**
     * {@inheritdoc}
     */
    public function getLimitVarName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLimitVarName');
        return $pluginInfo ? $this->___callPlugins('getLimitVarName', func_get_args(), $pluginInfo) : parent::getLimitVarName();
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailableLimit(array $limits)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAvailableLimit');
        return $pluginInfo ? $this->___callPlugins('setAvailableLimit', func_get_args(), $pluginInfo) : parent::setAvailableLimit($limits);
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableLimit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAvailableLimit');
        return $pluginInfo ? $this->___callPlugins('getAvailableLimit', func_get_args(), $pluginInfo) : parent::getAvailableLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstNum()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFirstNum');
        return $pluginInfo ? $this->___callPlugins('getFirstNum', func_get_args(), $pluginInfo) : parent::getFirstNum();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastNum()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastNum');
        return $pluginInfo ? $this->___callPlugins('getLastNum', func_get_args(), $pluginInfo) : parent::getLastNum();
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalNum()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTotalNum');
        return $pluginInfo ? $this->___callPlugins('getTotalNum', func_get_args(), $pluginInfo) : parent::getTotalNum();
    }

    /**
     * {@inheritdoc}
     */
    public function isFirstPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isFirstPage');
        return $pluginInfo ? $this->___callPlugins('isFirstPage', func_get_args(), $pluginInfo) : parent::isFirstPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastPageNum()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastPageNum');
        return $pluginInfo ? $this->___callPlugins('getLastPageNum', func_get_args(), $pluginInfo) : parent::getLastPageNum();
    }

    /**
     * {@inheritdoc}
     */
    public function isLastPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isLastPage');
        return $pluginInfo ? $this->___callPlugins('isLastPage', func_get_args(), $pluginInfo) : parent::isLastPage();
    }

    /**
     * {@inheritdoc}
     */
    public function isLimitCurrent($limit)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isLimitCurrent');
        return $pluginInfo ? $this->___callPlugins('isLimitCurrent', func_get_args(), $pluginInfo) : parent::isLimitCurrent($limit);
    }

    /**
     * {@inheritdoc}
     */
    public function isPageCurrent($page)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isPageCurrent');
        return $pluginInfo ? $this->___callPlugins('isPageCurrent', func_get_args(), $pluginInfo) : parent::isPageCurrent($page);
    }

    /**
     * {@inheritdoc}
     */
    public function getPages()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPages');
        return $pluginInfo ? $this->___callPlugins('getPages', func_get_args(), $pluginInfo) : parent::getPages();
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstPageUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFirstPageUrl');
        return $pluginInfo ? $this->___callPlugins('getFirstPageUrl', func_get_args(), $pluginInfo) : parent::getFirstPageUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getPreviousPageUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPreviousPageUrl');
        return $pluginInfo ? $this->___callPlugins('getPreviousPageUrl', func_get_args(), $pluginInfo) : parent::getPreviousPageUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getNextPageUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getNextPageUrl');
        return $pluginInfo ? $this->___callPlugins('getNextPageUrl', func_get_args(), $pluginInfo) : parent::getNextPageUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastPageUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastPageUrl');
        return $pluginInfo ? $this->___callPlugins('getLastPageUrl', func_get_args(), $pluginInfo) : parent::getLastPageUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getPageUrl($page)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPageUrl');
        return $pluginInfo ? $this->___callPlugins('getPageUrl', func_get_args(), $pluginInfo) : parent::getPageUrl($page);
    }

    /**
     * {@inheritdoc}
     */
    public function getLimitUrl($limit)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLimitUrl');
        return $pluginInfo ? $this->___callPlugins('getLimitUrl', func_get_args(), $pluginInfo) : parent::getLimitUrl($limit);
    }

    /**
     * {@inheritdoc}
     */
    public function getPagerUrl($params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPagerUrl');
        return $pluginInfo ? $this->___callPlugins('getPagerUrl', func_get_args(), $pluginInfo) : parent::getPagerUrl($params);
    }

    /**
     * {@inheritdoc}
     */
    public function getFrameStart()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFrameStart');
        return $pluginInfo ? $this->___callPlugins('getFrameStart', func_get_args(), $pluginInfo) : parent::getFrameStart();
    }

    /**
     * {@inheritdoc}
     */
    public function getFrameEnd()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFrameEnd');
        return $pluginInfo ? $this->___callPlugins('getFrameEnd', func_get_args(), $pluginInfo) : parent::getFrameEnd();
    }

    /**
     * {@inheritdoc}
     */
    public function getFramePages()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFramePages');
        return $pluginInfo ? $this->___callPlugins('getFramePages', func_get_args(), $pluginInfo) : parent::getFramePages();
    }

    /**
     * {@inheritdoc}
     */
    public function getPreviousJumpPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPreviousJumpPage');
        return $pluginInfo ? $this->___callPlugins('getPreviousJumpPage', func_get_args(), $pluginInfo) : parent::getPreviousJumpPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getPreviousJumpUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPreviousJumpUrl');
        return $pluginInfo ? $this->___callPlugins('getPreviousJumpUrl', func_get_args(), $pluginInfo) : parent::getPreviousJumpUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getNextJumpPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getNextJumpPage');
        return $pluginInfo ? $this->___callPlugins('getNextJumpPage', func_get_args(), $pluginInfo) : parent::getNextJumpPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getNextJumpUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getNextJumpUrl');
        return $pluginInfo ? $this->___callPlugins('getNextJumpUrl', func_get_args(), $pluginInfo) : parent::getNextJumpUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getFrameLength()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFrameLength');
        return $pluginInfo ? $this->___callPlugins('getFrameLength', func_get_args(), $pluginInfo) : parent::getFrameLength();
    }

    /**
     * {@inheritdoc}
     */
    public function getJump()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getJump');
        return $pluginInfo ? $this->___callPlugins('getJump', func_get_args(), $pluginInfo) : parent::getJump();
    }

    /**
     * {@inheritdoc}
     */
    public function setFrameLength($frame)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFrameLength');
        return $pluginInfo ? $this->___callPlugins('setFrameLength', func_get_args(), $pluginInfo) : parent::setFrameLength($frame);
    }

    /**
     * {@inheritdoc}
     */
    public function setJump($jump)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setJump');
        return $pluginInfo ? $this->___callPlugins('setJump', func_get_args(), $pluginInfo) : parent::setJump($jump);
    }

    /**
     * {@inheritdoc}
     */
    public function canShowFirst()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canShowFirst');
        return $pluginInfo ? $this->___callPlugins('canShowFirst', func_get_args(), $pluginInfo) : parent::canShowFirst();
    }

    /**
     * {@inheritdoc}
     */
    public function canShowLast()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canShowLast');
        return $pluginInfo ? $this->___callPlugins('canShowLast', func_get_args(), $pluginInfo) : parent::canShowLast();
    }

    /**
     * {@inheritdoc}
     */
    public function canShowPreviousJump()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canShowPreviousJump');
        return $pluginInfo ? $this->___callPlugins('canShowPreviousJump', func_get_args(), $pluginInfo) : parent::canShowPreviousJump();
    }

    /**
     * {@inheritdoc}
     */
    public function canShowNextJump()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canShowNextJump');
        return $pluginInfo ? $this->___callPlugins('canShowNextJump', func_get_args(), $pluginInfo) : parent::canShowNextJump();
    }

    /**
     * {@inheritdoc}
     */
    public function isFrameInitialized()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isFrameInitialized');
        return $pluginInfo ? $this->___callPlugins('isFrameInitialized', func_get_args(), $pluginInfo) : parent::isFrameInitialized();
    }

    /**
     * {@inheritdoc}
     */
    public function getAnchorTextForPrevious()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAnchorTextForPrevious');
        return $pluginInfo ? $this->___callPlugins('getAnchorTextForPrevious', func_get_args(), $pluginInfo) : parent::getAnchorTextForPrevious();
    }

    /**
     * {@inheritdoc}
     */
    public function getAnchorTextForNext()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAnchorTextForNext');
        return $pluginInfo ? $this->___callPlugins('getAnchorTextForNext', func_get_args(), $pluginInfo) : parent::getAnchorTextForNext();
    }

    /**
     * {@inheritdoc}
     */
    public function setIsOutputRequired($isRequired)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setIsOutputRequired');
        return $pluginInfo ? $this->___callPlugins('setIsOutputRequired', func_get_args(), $pluginInfo) : parent::setIsOutputRequired($isRequired);
    }

    /**
     * {@inheritdoc}
     */
    public function getFragment()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFragment');
        return $pluginInfo ? $this->___callPlugins('getFragment', func_get_args(), $pluginInfo) : parent::getFragment();
    }

    /**
     * {@inheritdoc}
     */
    public function setFragment($fragment)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFragment');
        return $pluginInfo ? $this->___callPlugins('setFragment', func_get_args(), $pluginInfo) : parent::setFragment($fragment);
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateContext($templateContext)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateContext');
        return $pluginInfo ? $this->___callPlugins('setTemplateContext', func_get_args(), $pluginInfo) : parent::setTemplateContext($templateContext);
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTemplate');
        return $pluginInfo ? $this->___callPlugins('getTemplate', func_get_args(), $pluginInfo) : parent::getTemplate();
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplate($template)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplate');
        return $pluginInfo ? $this->___callPlugins('setTemplate', func_get_args(), $pluginInfo) : parent::setTemplate($template);
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateFile($template = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTemplateFile');
        return $pluginInfo ? $this->___callPlugins('getTemplateFile', func_get_args(), $pluginInfo) : parent::getTemplateFile($template);
    }

    /**
     * {@inheritdoc}
     */
    public function getArea()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getArea');
        return $pluginInfo ? $this->___callPlugins('getArea', func_get_args(), $pluginInfo) : parent::getArea();
    }

    /**
     * {@inheritdoc}
     */
    public function assign($key, $value = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'assign');
        return $pluginInfo ? $this->___callPlugins('assign', func_get_args(), $pluginInfo) : parent::assign($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchView($fileName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'fetchView');
        return $pluginInfo ? $this->___callPlugins('fetchView', func_get_args(), $pluginInfo) : parent::fetchView($fileName);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBaseUrl');
        return $pluginInfo ? $this->___callPlugins('getBaseUrl', func_get_args(), $pluginInfo) : parent::getBaseUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectData(\Magento\Framework\DataObject $object, $key)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getObjectData');
        return $pluginInfo ? $this->___callPlugins('getObjectData', func_get_args(), $pluginInfo) : parent::getObjectData($object, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKeyInfo()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCacheKeyInfo');
        return $pluginInfo ? $this->___callPlugins('getCacheKeyInfo', func_get_args(), $pluginInfo) : parent::getCacheKeyInfo();
    }

    /**
     * {@inheritdoc}
     */
    public function getJsLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getJsLayout');
        return $pluginInfo ? $this->___callPlugins('getJsLayout', func_get_args(), $pluginInfo) : parent::getJsLayout();
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequest');
        return $pluginInfo ? $this->___callPlugins('getRequest', func_get_args(), $pluginInfo) : parent::getRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function getParentBlock()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParentBlock');
        return $pluginInfo ? $this->___callPlugins('getParentBlock', func_get_args(), $pluginInfo) : parent::getParentBlock();
    }

    /**
     * {@inheritdoc}
     */
    public function setLayout(\Magento\Framework\View\LayoutInterface $layout)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLayout');
        return $pluginInfo ? $this->___callPlugins('setLayout', func_get_args(), $pluginInfo) : parent::setLayout($layout);
    }

    /**
     * {@inheritdoc}
     */
    public function getLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLayout');
        return $pluginInfo ? $this->___callPlugins('getLayout', func_get_args(), $pluginInfo) : parent::getLayout();
    }

    /**
     * {@inheritdoc}
     */
    public function setNameInLayout($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setNameInLayout');
        return $pluginInfo ? $this->___callPlugins('setNameInLayout', func_get_args(), $pluginInfo) : parent::setNameInLayout($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildNames()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildNames');
        return $pluginInfo ? $this->___callPlugins('getChildNames', func_get_args(), $pluginInfo) : parent::getChildNames();
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($name, $value = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttribute');
        return $pluginInfo ? $this->___callPlugins('setAttribute', func_get_args(), $pluginInfo) : parent::setAttribute($name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function setChild($alias, $block)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setChild');
        return $pluginInfo ? $this->___callPlugins('setChild', func_get_args(), $pluginInfo) : parent::setChild($alias, $block);
    }

    /**
     * {@inheritdoc}
     */
    public function addChild($alias, $block, $data = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addChild');
        return $pluginInfo ? $this->___callPlugins('addChild', func_get_args(), $pluginInfo) : parent::addChild($alias, $block, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetChild($alias)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetChild');
        return $pluginInfo ? $this->___callPlugins('unsetChild', func_get_args(), $pluginInfo) : parent::unsetChild($alias);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetCallChild($alias, $callback, $result, $params)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetCallChild');
        return $pluginInfo ? $this->___callPlugins('unsetCallChild', func_get_args(), $pluginInfo) : parent::unsetCallChild($alias, $callback, $result, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetChildren()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetChildren');
        return $pluginInfo ? $this->___callPlugins('unsetChildren', func_get_args(), $pluginInfo) : parent::unsetChildren();
    }

    /**
     * {@inheritdoc}
     */
    public function getChildBlock($alias)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildBlock');
        return $pluginInfo ? $this->___callPlugins('getChildBlock', func_get_args(), $pluginInfo) : parent::getChildBlock($alias);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildHtml($alias = '', $useCache = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildHtml');
        return $pluginInfo ? $this->___callPlugins('getChildHtml', func_get_args(), $pluginInfo) : parent::getChildHtml($alias, $useCache);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildChildHtml($alias, $childChildAlias = '', $useCache = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildChildHtml');
        return $pluginInfo ? $this->___callPlugins('getChildChildHtml', func_get_args(), $pluginInfo) : parent::getChildChildHtml($alias, $childChildAlias, $useCache);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockHtml($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBlockHtml');
        return $pluginInfo ? $this->___callPlugins('getBlockHtml', func_get_args(), $pluginInfo) : parent::getBlockHtml($name);
    }

    /**
     * {@inheritdoc}
     */
    public function insert($element, $siblingName = 0, $after = true, $alias = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'insert');
        return $pluginInfo ? $this->___callPlugins('insert', func_get_args(), $pluginInfo) : parent::insert($element, $siblingName, $after, $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function append($element, $alias = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'append');
        return $pluginInfo ? $this->___callPlugins('append', func_get_args(), $pluginInfo) : parent::append($element, $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupChildNames($groupName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getGroupChildNames');
        return $pluginInfo ? $this->___callPlugins('getGroupChildNames', func_get_args(), $pluginInfo) : parent::getGroupChildNames($groupName);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildData($alias, $key = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildData');
        return $pluginInfo ? $this->___callPlugins('getChildData', func_get_args(), $pluginInfo) : parent::getChildData($alias, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        return $pluginInfo ? $this->___callPlugins('toHtml', func_get_args(), $pluginInfo) : parent::toHtml();
    }

    /**
     * {@inheritdoc}
     */
    public function getUiId($arg1 = null, $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUiId');
        return $pluginInfo ? $this->___callPlugins('getUiId', func_get_args(), $pluginInfo) : parent::getUiId($arg1, $arg2, $arg3, $arg4, $arg5);
    }

    /**
     * {@inheritdoc}
     */
    public function getJsId($arg1 = null, $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getJsId');
        return $pluginInfo ? $this->___callPlugins('getJsId', func_get_args(), $pluginInfo) : parent::getJsId($arg1, $arg2, $arg3, $arg4, $arg5);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($route = '', $params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        return $pluginInfo ? $this->___callPlugins('getUrl', func_get_args(), $pluginInfo) : parent::getUrl($route, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getViewFileUrl($fileId, array $params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getViewFileUrl');
        return $pluginInfo ? $this->___callPlugins('getViewFileUrl', func_get_args(), $pluginInfo) : parent::getViewFileUrl($fileId, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function formatDate($date = null, $format = 3, $showTime = false, $timezone = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'formatDate');
        return $pluginInfo ? $this->___callPlugins('formatDate', func_get_args(), $pluginInfo) : parent::formatDate($date, $format, $showTime, $timezone);
    }

    /**
     * {@inheritdoc}
     */
    public function formatTime($time = null, $format = 3, $showDate = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'formatTime');
        return $pluginInfo ? $this->___callPlugins('formatTime', func_get_args(), $pluginInfo) : parent::formatTime($time, $format, $showDate);
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getModuleName');
        return $pluginInfo ? $this->___callPlugins('getModuleName', func_get_args(), $pluginInfo) : parent::getModuleName();
    }

    /**
     * {@inheritdoc}
     */
    public function escapeHtml($data, $allowedTags = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeHtml');
        return $pluginInfo ? $this->___callPlugins('escapeHtml', func_get_args(), $pluginInfo) : parent::escapeHtml($data, $allowedTags);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeJs($string)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeJs');
        return $pluginInfo ? $this->___callPlugins('escapeJs', func_get_args(), $pluginInfo) : parent::escapeJs($string);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeHtmlAttr($string, $escapeSingleQuote = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeHtmlAttr');
        return $pluginInfo ? $this->___callPlugins('escapeHtmlAttr', func_get_args(), $pluginInfo) : parent::escapeHtmlAttr($string, $escapeSingleQuote);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeCss($string)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeCss');
        return $pluginInfo ? $this->___callPlugins('escapeCss', func_get_args(), $pluginInfo) : parent::escapeCss($string);
    }

    /**
     * {@inheritdoc}
     */
    public function stripTags($data, $allowableTags = null, $allowHtmlEntities = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'stripTags');
        return $pluginInfo ? $this->___callPlugins('stripTags', func_get_args(), $pluginInfo) : parent::stripTags($data, $allowableTags, $allowHtmlEntities);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeUrl($string)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeUrl');
        return $pluginInfo ? $this->___callPlugins('escapeUrl', func_get_args(), $pluginInfo) : parent::escapeUrl($string);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeXssInUrl($data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeXssInUrl');
        return $pluginInfo ? $this->___callPlugins('escapeXssInUrl', func_get_args(), $pluginInfo) : parent::escapeXssInUrl($data);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeQuote($data, $addSlashes = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeQuote');
        return $pluginInfo ? $this->___callPlugins('escapeQuote', func_get_args(), $pluginInfo) : parent::escapeQuote($data, $addSlashes);
    }

    /**
     * {@inheritdoc}
     */
    public function escapeJsQuote($data, $quote = '\'')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'escapeJsQuote');
        return $pluginInfo ? $this->___callPlugins('escapeJsQuote', func_get_args(), $pluginInfo) : parent::escapeJsQuote($data, $quote);
    }

    /**
     * {@inheritdoc}
     */
    public function getNameInLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getNameInLayout');
        return $pluginInfo ? $this->___callPlugins('getNameInLayout', func_get_args(), $pluginInfo) : parent::getNameInLayout();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCacheKey');
        return $pluginInfo ? $this->___callPlugins('getCacheKey', func_get_args(), $pluginInfo) : parent::getCacheKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getVar($name, $module = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVar');
        return $pluginInfo ? $this->___callPlugins('getVar', func_get_args(), $pluginInfo) : parent::getVar($name, $module);
    }

    /**
     * {@inheritdoc}
     */
    public function isScopePrivate()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isScopePrivate');
        return $pluginInfo ? $this->___callPlugins('isScopePrivate', func_get_args(), $pluginInfo) : parent::isScopePrivate();
    }

    /**
     * {@inheritdoc}
     */
    public function addData(array $arr)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addData');
        return $pluginInfo ? $this->___callPlugins('addData', func_get_args(), $pluginInfo) : parent::addData($arr);
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setData');
        return $pluginInfo ? $this->___callPlugins('setData', func_get_args(), $pluginInfo) : parent::setData($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetData($key = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetData');
        return $pluginInfo ? $this->___callPlugins('unsetData', func_get_args(), $pluginInfo) : parent::unsetData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getData($key = '', $index = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getData');
        return $pluginInfo ? $this->___callPlugins('getData', func_get_args(), $pluginInfo) : parent::getData($key, $index);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByPath($path)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByPath');
        return $pluginInfo ? $this->___callPlugins('getDataByPath', func_get_args(), $pluginInfo) : parent::getDataByPath($path);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByKey($key)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByKey');
        return $pluginInfo ? $this->___callPlugins('getDataByKey', func_get_args(), $pluginInfo) : parent::getDataByKey($key);
    }

    /**
     * {@inheritdoc}
     */
    public function setDataUsingMethod($key, $args = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('setDataUsingMethod', func_get_args(), $pluginInfo) : parent::setDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataUsingMethod($key, $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('getDataUsingMethod', func_get_args(), $pluginInfo) : parent::getDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function hasData($key = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasData');
        return $pluginInfo ? $this->___callPlugins('hasData', func_get_args(), $pluginInfo) : parent::hasData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toArray');
        return $pluginInfo ? $this->___callPlugins('toArray', func_get_args(), $pluginInfo) : parent::toArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToArray');
        return $pluginInfo ? $this->___callPlugins('convertToArray', func_get_args(), $pluginInfo) : parent::convertToArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(array $keys = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toXml');
        return $pluginInfo ? $this->___callPlugins('toXml', func_get_args(), $pluginInfo) : parent::toXml($keys, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToXml(array $arrAttributes = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToXml');
        return $pluginInfo ? $this->___callPlugins('convertToXml', func_get_args(), $pluginInfo) : parent::convertToXml($arrAttributes, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toJson');
        return $pluginInfo ? $this->___callPlugins('toJson', func_get_args(), $pluginInfo) : parent::toJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToJson');
        return $pluginInfo ? $this->___callPlugins('convertToJson', func_get_args(), $pluginInfo) : parent::convertToJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toString($format = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toString');
        return $pluginInfo ? $this->___callPlugins('toString', func_get_args(), $pluginInfo) : parent::toString($format);
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $args)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '__call');
        return $pluginInfo ? $this->___callPlugins('__call', func_get_args(), $pluginInfo) : parent::__call($method, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isEmpty');
        return $pluginInfo ? $this->___callPlugins('isEmpty', func_get_args(), $pluginInfo) : parent::isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($keys = [], $valueSeparator = '=', $fieldSeparator = ' ', $quote = '"')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'serialize');
        return $pluginInfo ? $this->___callPlugins('serialize', func_get_args(), $pluginInfo) : parent::serialize($keys, $valueSeparator, $fieldSeparator, $quote);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($data = null, &$objects = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'debug');
        return $pluginInfo ? $this->___callPlugins('debug', func_get_args(), $pluginInfo) : parent::debug($data, $objects);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetSet');
        return $pluginInfo ? $this->___callPlugins('offsetSet', func_get_args(), $pluginInfo) : parent::offsetSet($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetExists');
        return $pluginInfo ? $this->___callPlugins('offsetExists', func_get_args(), $pluginInfo) : parent::offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetUnset');
        return $pluginInfo ? $this->___callPlugins('offsetUnset', func_get_args(), $pluginInfo) : parent::offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetGet');
        return $pluginInfo ? $this->___callPlugins('offsetGet', func_get_args(), $pluginInfo) : parent::offsetGet($offset);
    }
}
