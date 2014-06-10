<?php

Yii::import('bootstrap.widgets.TbTabs');
Yii::import('bootstrap.widgets.TbMenu');

class Tabs extends TbTabs {

    public $items;

    public function init() {
        parent::init();

        //$this->type = 'pills nav-stacked';

        $this->items = $this->tabs;

        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;
        $url = $controller . '/' . $action;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = null;
        }

        $hasActive = false;
        foreach ($this->items as $key => $item) {
            if (!isset($item['active'])) {
                $this->items[$key]['active'] = false;
            }
            if (!isset($item['url']))
                continue;
            if ($item['url'][0] === $url) {
                if (isset($item['url']['id'])) {
                    if ((int) $item['url']['id'] === (int) $id) {
                        $this->items[$key]['active'] = true;
                        $hasActive = true;
                        break;
                    }
                } elseif ($id === null) {
                    $this->items[$key]['active'] = true;
                    $hasActive = true;
                    break;
                }
            }
        }

        if (!$hasActive) {
            foreach ($this->items as $key => $item) {
                if (!isset($item['items']))
                    continue;
                foreach ($item['items'] as $i => $subitem) {
                    if ($subitem['url'][0] === $url) {
                        if (isset($subitem['url']['id'])) {
                            if ((int) $subitem['url']['id'] === (int) $id) {
                                $this->items[$key]['active'] = true;
                                $hasActive = true;
                                break;
                            }
                        } elseif ($id === null) {
                            $this->items[$key]['active'] = true;
                            $hasActive = true;
                            break;
                        }
                    }
                }
            }
        }

        if (!$hasActive) {
            $this->items[0]['active'] = true;
            $hasActive = true;
        }

        //Helper::printer($this->items, false);


        /*
          if(!$hasActive)
          {
          foreach($this->items as $key=>$item)
          {
          if($item['url'][0] === $url)
          {
          $this->items[$key]['active'] = true;
          $hasActive = true;
          break;
          }
          }
          }

          if(!$hasActive)
          {
          foreach($this->items as $key=>$item)
          {
          $currentUrl = explode('/',$item['url'][0]);
          if($currentUrl[0] === $controller)
          {
          $this->items[$key]['active'] = true;
          $hasActive = true;
          break;
          }
          }
          }

          if(!$hasActive)
          {
          foreach($this->items as $key=>$item)
          {
          $currentUrl = explode('/',$item['url'][0]);
          if(($currentUrl[0] === 'category' and $controller === 'template')
          or
          ($currentUrl[0] === 'folder' and $controller === 'document'))
          {
          $this->items[$key]['active'] = true;
          $hasActive = true;
          break;
          }

          }
          } */
    }

    /**
     * Run this widget.
     */
    public function run() {
        $id = $this->id;
        $content = array();
        $items = $this->normalizeTabs($this->items, $content);

        //Helper::printer($this->items);

        ob_start();
        $this->controller->widget('application.components.widgets.Menu', array(
            'type' => $this->type,
            'encodeLabel' => $this->encodeLabel,
            'items' => $items,
        ));
        $tabs = ob_get_clean();

        ob_start();
        echo '<div class="tab-content">';
        echo implode('', $content);
        echo '</div>';
        $content = ob_get_clean();

        echo CHtml::openTag('div', $this->htmlOptions);
        echo $this->placement === self::PLACEMENT_BELOW ? $content . $tabs : $tabs . $content;
        echo '</div>';

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript(__CLASS__ . '#' . $id, "jQuery('#{$id}').tab('show');");

        foreach ($this->events as $name => $handler) {
            $handler = CJavaScript::encode($handler);
            $cs->registerScript(__CLASS__ . '#' . $id . '_' . $name, "jQuery('#{$id}').on('{$name}', {$handler});");
        }
    }

    /**
     * Normalizes the tab configuration.
     * @param array $tabs the tab configuration
     * @param array $panes a reference to the panes array
     * @param integer $i the current index
     * @return array the items
     */
    protected function normalizeTabs($tabs, &$panes, &$i = 0) {
        $id = $this->getId();
        $items = array();

        foreach ($tabs as $tab) {
            $item = $tab;

            if (isset($item['visible']) && $item['visible'] === false)
                continue;

            if (!isset($item['itemOptions']))
                $item['itemOptions'] = array();

            if (isset($tab['items'])) {
                $item['items'] = array();
                $item['content'] = count($tab['items']);
            }

            if (!isset($item['id']))
                $item['id'] = $id . '_tab_' . ($i + 1);

            if (!isset($item['url'])) {
                $item['url'] = '#' . $item['id'];
                $item['linkOptions']['data-toggle'] = 'tab';
                //$item['linkOptions']['class'] = 'tab1';
            }

            if (!isset($item['content']))
                $item['content'] = '';

            if (isset($tab['items'])) {
                ob_start();
                ob_implicit_flush(false);
                $widget = Yii::app()->getWidgetFactory()->createWidget($this, 'bootstrap.widgets.TbMenu', array(
                    'type' => 'pills',
                    'stacked' => false,
                    'items' => $tab['items'],
                ));
                $widget->init();
                $widget->run();
                $item['content'] = ob_get_clean();
                unset($item['items']);
                unset($widget);
            }

            $content = $item['content'];
            unset($item['content']);

            if (!isset($item['paneOptions']))
                $item['paneOptions'] = array();

            $paneOptions = $item['paneOptions'];
            unset($item['paneOptions']);

            $paneOptions['id'] = $item['id'];

            $classes = array('tab-pane fade');

            //var_dump($tab['active']);
            if (isset($tab['active']) && $tab['active'] === true) {
                $classes[] = 'active in';
                $item['active'] = true;
                $item['linkOptions']['class'] = 'active1';
                //die('active');
            }

            $classes = implode(' ', $classes);
            if (isset($paneOptions['class']))
                $paneOptions['class'] .= ' ' . $classes;
            else
                $paneOptions['class'] = $classes;

            $panes[] = CHtml::tag('div', $paneOptions, $content);

            $i++; // increment the tab-index

            $items[] = $item;
        }

        //Helper::printer($items, false);
        //Helper::printer($panes);

        return $items;
    }

}