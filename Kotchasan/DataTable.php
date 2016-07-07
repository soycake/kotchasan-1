<?php
/*
 * @filesource Kotchasan/DataTable.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Kotchasan;

use \Kotchasan\ArrayTool;
use \Kotchasan\Language;
use \Kotchasan\Orm\Recordset;

/**
 * คลาสสำหรับจัดการแสดงผลข้อมูลจาก Model ในรูปแบบตาราง
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class DataTable extends \Kotchasan\KBase
{
  /**
   * id ของตาราง
   *
   * @var string
   */
  private $id;
  /**
   * ชื่อ Model ที่ต้องการเรียกข้อมูล
   *
   * @var string
   */
  private $model;
  /**
   * Recordset
   *
   * @var \Kotchasan\Orm\Recordset
   */
  private $rs;
  /**
   * ข้อมูลทั้งหมดของตารางรูปแบบแอเรย์
   * หากไม่ได้ใช้ตารางเชื่อมต่อกับ Model ให้กำหนดข้อมูลทั้งหมดที่นี่
   *
   * @var array
   */
  private $datas;
  /**
   * database cache
   *
   * @var bool
   */
  private $cache = false;
  /**
   * รายชื่อฟิลด์ที่จะ query
   *
   * @var array
   */
  private $fields = array();
  /**
   * คอลัมน์ของ checkbox
   * -1 ไม่แสดง checkbox
   *
   * @var int
   */
  private $checkCol = -1;
  /**
   * แสดงตารางกว้าง 100%
   *
   * @var bool
   */
  private $fullWidth = true;
  /**
   * แสดงเส้นกรอบ
   *
   * @var bool
   */
  private $border = false;
  /**
   * แสดงปุ่ม สำหรับเพิ่มและลบแถว
   *
   * @var bool
   */
  private $pmButton = false;
  /**
   * แสดงตารางแบบ responsive
   *
   * @var bool
   */
  private $responsive = false;
  /**
   * แสดงส่วนหัวของตาราง
   *
   * @var bool
   */
  private $showCaption = true;
  /**
   * URL สำหรับรับค่าจาก action ต่างๆ เช่นการลบ
   * เช่น index/[controller|model]/className/method.php
   *
   * @var string
   */
  private $action;
  /**
   * ถ้ากำหนดรายการนี้จะแสดง checkbox และ ปุ่ม action
   * array('delete' => Language::get('Delete'), 'published' => Language::get('Published'))
   * หมายถึงแสดง select สำหรับ ลบ และ เผยแพร่
   *
   * @var array
   */
  private $actions = array();
  /**
   * ชื่อฟังก์ชั่น Javascript เรียกหลังจากทำการส่งค่าจาก action ไปประมวลผลแล้ว
   * เช่น doFormSubmit
   *
   * @var string
   */
  private $actionCallback;
  /**
   * ชื่อฟังก์ชั่น Javascript เรียกหลังจากคลิก action
   * เช่น confirmAction
   *
   * @var string
   */
  private $actionConfirm;
  /**
   * method สำหรับจัดการข้อมูลแต่ละแถวก่อนการแสดงผล
   *
   * @var array array($this, methodName)
   */
  private $onRow;
  /**
   * ลิสต์คำสั่ง Query หลัก สำหรับคัดเลือกข้อมูล
   * array('id', 1) WHERE `id` = 1 AND ...
   * array('id', array(1, 2)) WHERE `id` IN (1, 2) AND ...
   * array('id', '!=' , 1) WHERE `id` != 1 AND ...
   *
   * @var array
   */
  public $defaultFilters = array();
  /**
   * ฟิลเตอร์ข้อมูลแสดงผล
   * ถ้ากำหนดรายการนี้จะแสดงตัวเลือกการ filter ด้านบนตาราง
   *
   * @var array
   */
  public $filters = array();
  /**
   * รายชื่อคอลัมน์ที่ไม่ต้องแสดงผล
   *
   * @var array
   */
  public $hideColumns = array();
  /**
   * รายชื่อคอลัมน์ทั้งหมด
   *
   * @var array
   */
  public $columns = array();
  /**
   * รายชื่อส่วนหัวของตอลัมน์
   *
   * @var array
   */
  public $headers = array();
  /**
   * รายชื่อฟิลด์ที่สามารถค้นหาได้
   * ถ้ากำหนดรายการนี้จะแสดงกล่องค้นหา
   *
   * @var array
   */
  public $searchColumns = array();
  /**
   * จำนวนรายการต่อหน้า
   * ถ้ากำหนดรายการนี้จะแสดงรายการแบ่งหน้า และตัวเลือกแสดงรายการต่อหน้า
   *
   * @var int
   */
  public $perPage;
  /**
   * ชื่อคอลัมน์ที่ใช้เรียงลำดับ
   *
   * @var string
   */
  public $sort;
  /**
   * ข้อมูลการเรียงลำดับที่กำลังใช้งานอยู่
   *
   * @var array
   */
  protected $sorts = array();
  /**
   * ปุ่มที่จะใส่ไว้ด้านหลังของแต่ละแถว
   *
   * @var array
   */
  public $buttons = array();
  /**
   * method สำหรับเตรียมการแสดงผล button
   * ถ้าคืนค่า false กลับมาจะไม่มีการสรางปุ่ม
   *
   * @var array array($this, methodName)
   */
  private $onCreateButton;
  /**
   * กำหนดคอลัมน์ หากยอมให้สามารถจัดลำดับตารางด้วยการลากได้
   *
   * @var int
   */
  private $dragColumn = -1;
  /**
   * ชื่อคีย์หลักของข้อมูล
   * สำหรับอ่าน id ของ แถว
   *
   * @var string
   */
  private $primaryKey = 'id';
  /**
   * Javascript
   *
   * @var array
   */
  private $javascript = array();

  /**
   * Initial Class
   *
   * @param array $param
   */
  public function __construct($param)
  {
    $this->id = 'datatable';
    foreach ($param as $key => $value) {
      $this->$key = $value;
    }
    if (!empty($this->actions) && $this->checkCol == -1) {
      $this->checkCol = 1;
    }
    // รายการต่อหน้า มาจากการเลือกภายในตารง
    $count = self::$request->request('count')->toInt();
    if ($count > 0) {
      $this->perPage = $count;
    }
    // header ของตาราง มาจาก model หรือมาจากข้อมูล หรือ มาจากการกำหนดเอง
    if (isset($this->model)) {
      // create Recordset
      $this->rs = new Recordset($this->model);
      // ฟิลด์ที่กำหนด (หากแตกต่างจาก Model)
      $first = $this->rs->first($this->fields);
      // อ่านคอลัมน์ของตาราง
      if ($first === false) {
        if (!empty($this->fields)) {
          foreach ($this->fields as $field) {
            if (preg_match('/(.*?[`\s]+)?([a-z0-9_]+)`?$/i', $field, $match)) {
              $this->columns[$match[2]] = array('text' => $match[2]);
            }
          }
        }
      } else {
        $this->columns = $this->rs->getFields();
      }
    } elseif (isset($this->datas)) {
      // อ่านคอลัมน์จากข้อมูลเราการแรก
      $this->columns = array();
      if (!empty($this->datas)) {
        foreach (reset($this->datas) as $key => $value) {
          $this->columns[$key] = array('text' => $key);
        }
      }
    }
    // จัดการ header, ตรวจสอบกับค่ากำหนดมา เรียงลำดับ header ตาม columns
    if (!empty($this->columns)) {
      $headers = array();
      foreach ($this->columns as $field => $attributes) {
        if (!in_array($field, $this->hideColumns)) {
          if (isset($this->headers[$field])) {
            $headers[$field] = $this->headers[$field];
            if (!isset($headers[$field]['text'])) {
              $headers[$field]['text'] = $field;
            }
          } else {
            $headers[$field]['text'] = $field;
          }
        }
      }
      $this->headers = $headers;
    }
    $this->sort = self::$request->request('sort', $this->sort)->toString();
  }

  /**
   * กำหนด Javascript
   *
   * @param string $script
   */
  public function script($script)
  {
    $this->javascript[] = $script;
  }

  /**
   * สร้างตาราง และเริ่มต้นทำงานตาราง
   * คืนค่าเป็นโค้ด HTML ของ DataTable
   *
   * @return string
   */
  public function render()
  {
    $url_query = array();
    $hidden_fields = array();
    foreach (self::$request->getQueryParams() as $key => $value) {
      $value = rawurlencode($value);
      $url_query[$key] = $key.'='.$value;
      // แอเรย์เก็บรายการ input ที่ไม่ต้องสร้าง
      if ($key !== 'search' && $key !== 'count' && $key !== 'page' && $key !== 'action') {
        $hidden_fields[$key] = '<input type="hidden" name="'.$key.'" value="'.$value.'">';
      }
    }
    if (isset($this->model)) {
      // รายการ Query หลัก (AND)
      $qs = array();
      foreach ($this->defaultFilters as $array) {
        $qs[] = $array;
      }
    }
    // create HTML
    $content = array('<div class="datatable" id="'.$this->id.'">');
    // form
    $form = array();
    if (isset($this->perPage)) {
      $entries = Language::get('entries');
      $form[] = $this->addFilter(array(
        'name' => 'count',
        'text' => Language::get('Show'),
        'value' => $this->perPage,
        'options' => array(10 => '10 '.$entries, 20 => '20 '.$entries, 30 => '30 '.$entries, 40 => '40 '.$entries, 50 => '50 '.$entries, 100 => '100 '.$entries)
      ));
    }
    // รายการ Query กำหนดโดย User (AND)
    foreach ($this->filters as $key => $items) {
      $form[] = $this->addFilter($items);
      unset($hidden_fields[$items['name']]);
      if (!isset($items['default'])) {
        $items['default'] = '';
      }
      // ไม่ Query รายการ default
      if (!empty($items['options']) && isset($items['value']) && $items['value'] !== $items['default'] && in_array($items['value'], array_keys($items['options']), true)) {
        $qs[] = array($key, $items['value']);
      }
    }
    // ปุ่ม Go
    if (!empty($form)) {
      $form[] = '<fieldset>';
      $form[] = '<input type=submit class="button go" value="'.Language::get('Go').'">';
      $form[] = implode('', $hidden_fields);
      $form[] = '</fieldset>';
    }
    // search
    $search = self::$request->request('search')->text();
    if (!empty($this->searchColumns)) {
      if (!empty($search)) {
        if (isset($this->model)) {
          $sh = array();
          foreach ($this->searchColumns as $key) {
            $sh[] = array($key, 'LIKE', "%$search%");
          }
          $qs[] = $this->rs->group($sh, 'OR');
        } elseif (isset($this->datas)) {
          // filter ข้อมูลจาก array
          $this->datas = ArrayTool::filter($this->datas, $search);
        }
      }
      $form[] = '&nbsp;<fieldset class=search>';
      $form[] = '<label accesskey=f class="icon-search"><input type=text name=search value="'.$search.'" placeholder="'.Language::get('Search').'"></label>';
      $form[] = '<input type=submit value="&nbsp;">';
      $form[] = '</fieldset>';
    }
    if (!empty($form)) {
      $content[] = '<form class="table_nav" method="get">'.implode('', $form).'</form>';
    }
    if (isset($this->model)) {
      // Model
      $query = $this->rs->where($qs)->toArray();
      if ($this->cache) {
        $this->rs->cacheOn();
      }
      // จำนวนข้อมูลทั้งหมด
      $count = $this->rs->count();
    } elseif (!empty($this->datas)) {
      // จำนวนข้อมูลใน array
      $count = sizeof($this->datas);
    } else {
      $count = 0;
    }
    // การแบ่งหน้า
    if (empty($this->perPage)) {
      $start = 0;
      $totalpage = 1;
      $page = 1;
      $s = 1;
      $e = $count;
      $this->perPage = 0;
    } else {
      // หน้าที่เลือก
      $page = max(1, self::$request->request('page', 1)->toInt());
      // ตรวจสอบหน้าที่เลือกสูงสุด
      $totalpage = round($count / $this->perPage);
      $totalpage += ($totalpage * $this->perPage < $count) ? 1 : 0;
      $page = max(1, $page > $totalpage ? $totalpage : $page);
      $start = $this->perPage * ($page - 1);
      // คำนวณรายการที่แสดง
      $s = $start < 0 ? 0 : $start + 1;
      $e = min($count, $s + $this->perPage - 1);
    }
    // table caption
    if ($this->showCaption) {
      if (empty($search)) {
        $caption = Language::get('All :count entries, displayed :start to :end, page :page of :total pages');
      } else {
        $caption = Language::get('Search <strong>:search</strong> found :count entries, displayed :start to :end, page :page of :total pages');
      }
      $caption = str_replace(array(':search', ':count', ':start', ':end', ':page', ':total'), array($search, number_format($count), number_format($s), number_format($e), number_format($page), number_format($totalpage)), $caption);
    }
    // เรียงลำดับ
    if (!empty($this->sort)) {
      $sorts = array();
      foreach (explode(',', $this->sort) as $sort) {
        if (preg_match('/^([a-z0-9_\-]+)([\s]+(desc|asc))?$/i', trim($sort), $match)) {
          $sort = isset($this->headers[$match[1]]['sort']) ? $this->headers[$match[1]]['sort'] : $match[1];
          $sortType = isset($match[3]) && strtolower($match[3]) == 'desc' ? 'desc' : 'asc';
          $this->sorts[$sort] = $sortType;
          $sorts[] = $sort.' '.$sortType;
        }
      }
      $this->sort = implode(',', $sorts);
      if (isset($this->model)) {
        if (!empty($sorts)) {
          $query->order($sorts);
        }
      } elseif (!empty($this->sorts)) {
        reset($this->sorts);
        $sort = key($this->sorts);
        $this->datas = ArrayTool::sort($this->datas, $sort, $this->sorts[$sort]);
      }
    }
    if (isset($this->model)) {
      // query ข้อมูล
      $this->datas = $this->rs->take($start, $this->perPage)->execute($this->fields);
      // รายการสุดท้าย
      $end = $this->perPage + 1;
      // รายการแรก
      $start = -1;
    } elseif (isset($this->datas)) {
      // รายการสุดท้าย
      $end = $start + $this->perPage - 1;
      // รายการแรก
      $start = $start - 2;
    } else {
      $end = 0;
    }
    if (!empty($this->headers)) {
      // property ของ ตาราง
      $prop = array();
      $c = array();
      if (isset($this->class)) {
        $c[] = $this->class;
      }
      if ($this->border) {
        $c[] = 'border';
      }
      if ($this->responsive) {
        $c[] = 'responsive-v';
      }
      if ($this->fullWidth) {
        $c[] = 'fullwidth';
      }
      if (sizeof($c) > 0) {
        $prop[] = ' class="'.implode(' ', $c).'"';
      }
      // table
      $content[] = '<div class="tablebody"><table'.implode('', $prop).'>';
      if ($this->showCaption) {
        $content[] = '<caption>'.$caption.'</caption>';
      }
      $row = array();
      $i = 0;
      $colCount = 0;
      $colspan = 0;
      foreach ($this->headers as $key => $attributes) {
        if ($colspan === 0) {
          if ($i == $this->checkCol) {
            $row[] = '<th class="check-column"><a class="checkall icon-uncheck"></a></th>';
            $colCount++;
          }
          if ($i == $this->dragColumn) {
            $row[] = '<th></th>';
            $colCount++;
          }
          if (isset($attributes['colspan'])) {
            $colspan = $attributes['colspan'] - 1;
          }
          $row[] = $this->th($i, $key, $attributes);
          $colCount++;
          $i++;
        } else {
          $colspan--;
        }
      }
      if (!empty($this->buttons)) {
        $row[] = $this->th($i, '', array('text' => ''));
        $colCount++;
        $i++;
      }
      if ($this->pmButton) {
        $row[] = $this->th($i, '', array('text' => ''));
        $colCount++;
      }
      // thead
      $content[] = '<thead><tr>'.implode('', $row).'</tr></thead>';
      // tbody
      if (!empty($this->datas)) {
        $content[] = '<tbody>'.$this->tbody($start, $end).'</tbody>';
      }
      // tfoot
      if ($this->checkCol > -1) {
        $row = array();
        $row[] = '<td colspan="'.$this->checkCol.'"></td>';
        $row[] = '<td class="check-column"><a class="checkall icon-uncheck"></a></td>';
        $row[] = '<td colspan="'.($colCount - $this->checkCol - 1).'"></td>';
        $content[] = '<tfoot><tr>'.implode('', $row).'</tr></tfoot>';
      }
      $content[] = '</table></div>';
      $table_nav = array();
      foreach ($this->actions as $item) {
        $table_nav[] = $this->addAction($item);
      }
      if (!empty($this->addNew)) {
        $prop = array();
        foreach ($this->addNew as $k => $v) {
          $prop[$k] = $k.'="'.$v.'"';
        }
        if (preg_match('/^((.*)\s+)?(icon-[a-z0-9\-_]+)(\s+(.*))?$/', $this->addNew['class'], $match)) {
          $prop['class'] = 'class="'.trim($match[2].' '.(isset($match[5]) ? $match[5] : '')).'"';
          $table_nav[] = '<a '.implode(' ', $prop).'><span class="'.$match[3].'">'.(isset($this->addNew['text']) ? $this->addNew['text'] : '').'</span></a>';
        } else {
          $table_nav[] = '<a '.implode(' ', $prop).'>'.(isset($this->addNew['text']) ? $this->addNew['text'] : '').'</a>';
        }
      }
      if (!empty($table_nav)) {
        $content[] = '<div class="table_nav action">'.implode('', $table_nav).'</div>';
      }
      // แบ่งหน้า
      if (!empty($this->perPage)) {
        $content[] = '<div class="splitpage">'.self::$request->getUri()->pagination($totalpage, $page).'</div>';
      }
    }
    $content[] = '</div>';
    $script = array(
      'page' => $page,
      'search' => $search,
      'sort' => $this->sort,
      'action' => $this->action,
      'actionCallback' => $this->actionCallback,
      'actionConfirm' => $this->actionConfirm,
      'pmButton' => $this->pmButton,
      'dragColumn' => $this->dragColumn
    );
    $this->javascript[] = 'var table = new GTable("'.$this->id.'", '.json_encode($script).');';
    $content[] = "<script>\n".implode("\n", $this->javascript)."\n</script>";
    return implode("\n", $content);
  }

  /**
   * render tbody
   *
   * @param int $start ข้อมูลเริ่มต้น (เริ่มที่ 1)
   * @return string
   */
  public function tbody($start, $end)
  {
    $row = array();
    $n = 0;
    foreach ($this->datas as $o => $items) {
      if (empty($this->perPage) || ($n > $start && $n < $end)) {
        $src_items = $items;
        // id ของข้อมูล
        $id = isset($items[$this->primaryKey]) ? $items[$this->primaryKey] : $o;
        $prop = array('id="'.$this->id.'_'.$id.'"');
        if (isset($this->onRow)) {
          $items = call_user_func($this->onRow, $items, $o, $prop);
        }
        if (isset($this->dragColumn)) {
          $prop[] = 'class="sort"';
        }
        // แถว
        $row[] = '<tr '.implode(' ', $prop).'>';
        // แสดงผลข้อมูล
        $i = 0;
        foreach ($this->headers as $field => $attributes) {
          if (!empty($field) && !in_array($field, $this->hideColumns)) {
            if ($i == $this->checkCol) {
              $row[] = '<td headers="r'.$id.'" class="check-column"><a id="check_'.$id.'" class="icon-uncheck"></a></td>';
            }
            if ($i == $this->dragColumn) {
              $row[] = '<td class=center><a id="move_'.$id.'" title="'.Language::get('Drag and drop to reorder').'" class="icon-move"></a></td>';
            }
            $properties = isset($this->cols[$field]) ? $this->cols[$field] : array();
            $text = isset($items[$field]) ? $items[$field] : '';
            $th = isset($attributes['text']) ? $attributes['text'] : $field;
            $row[] = $this->td($id, $i, $properties, $text, $th);
            $i++;
          }
        }
        if (!empty($this->buttons)) {
          $buttons = array();
          foreach ($this->buttons as $btn => $attributes) {
            if (isset($this->onCreateButton)) {
              $attributes = call_user_func($this->onCreateButton, $btn, $attributes, $items);
            }
            if ($attributes !== false) {
              $buttons[] = $this->button($btn, $attributes);
            }
          }
          if (!empty($buttons)) {
            $module_id = isset($items['module_id']) ? $items['module_id'] : 0;
            $patt = array();
            $replace = array();
            $keys = array_keys($src_items);
            rsort($keys);
            foreach ($keys as $k) {
              if (!is_array($src_items[$k])) {
                $patt[] = ":$k";
                $replace[] = $src_items[$k];
              }
            }
            $row[] = str_replace($patt, $replace, $this->td($id, $i, array('class' => 'buttons'), implode('', $buttons), ''));
          }
        }
        if ($this->pmButton) {
          $row[] = '<td class="icons"><div><a class="icon-plus" title="'.Language::get('Add').'"></a><a class="icon-minus" title="'.Language::get('Remove').'"></a></div></td>';
        }
        $row[] = '</tr>';
      }
      $n++;
    }
    return implode("\n", $row);
  }

  /**
   * render th
   *
   * @param int $i ลำดับคอลัมน์
   * @param string $column ชื่อคอลัมน์
   * @param array $properties properties ของ th
   * @return string
   */
  private function th($i, $column, $properties)
  {
    $c = array();
    $c['id'] = 'id="c'.$i.'"';
    if (!empty($properties['sort'])) {
      $sort = isset($this->sorts[$properties['sort']]) ? $this->sorts[$properties['sort']] : 'none';
      $properties['class'] = 'sort_'.$sort.' col_'.$column.(empty($properties['class']) ? '' : ' '.$properties['class']);
    }
    foreach ($properties as $key => $value) {
      if ($key !== 'sort' && $key !== 'text') {
        $c[$key] = $key.'="'.$value.'"';
      }
    }
    return '<th '.implode(' ', $c).'>'.(isset($properties['text']) ? $properties['text'] : $column).'</th>';
  }

  /**
   * render td
   *
   * @param int $id id ของ แถว
   * @param int $i ลำดับคอลัมน์
   * @param array $properties ชื่อคอลัมน์
   * @param string $text ข้อความใน td
   * @return string
   */
  private function td($id, $i, $properties, $text, $th)
  {
    $c = array('data-text' => 'data-text="'.$th.'"');
    foreach ($properties as $key => $value) {
      $c[$key] = $key.'="'.$value.'"';
    }
    $c = implode(' ', $c);
    if ($i == 0) {
      $c .= ' id="r'.$id.'" headers="c'.$i.'"';
      return '<th '.$c.'>'.$text.'</th>';
    } else {
      $c .= ' headers="c'.$i.' r'.$id.'"';
      return '<td '.$c.'>'.$text.'</td>';
    }
  }

  /**
   * render button
   *
   * @param array $properties properties ของ button
   * @return string
   */
  private function button($btn, $properties)
  {
    $prop = array();
    foreach ($properties as $key => $value) {
      if ($key === 'id') {
        $prop[$key] = $key.'="'.$btn.'_'.$value.'"';
      } elseif ($key !== 'text') {
        $prop[$key] = $key.'="'.$value.'"';
      }
    }
    if (!empty($properties['class']) && preg_match('/(.*)\s?(icon\-[a-z0-9\-_]+)($|\s(.*))/', $properties['class'], $match)) {
      $class = array();
      foreach (array(1, 4)as $i) {
        if (!empty($match[$i])) {
          $class[] = $match[$i];
        }
      }
      $prop['class'] = 'class="'.implode(' ', $class).'"';
      return '<a '.implode(' ', $prop).'><span class="'.$match[2].'">'.(isset($properties['text']) ? $properties['text'] : '').'</span></a>';
    } else {
      return '<a'.(empty($prop) ? '' : ' '.implode(' ', $prop)).'></a>';
    }
  }

  /**
   * สร้าง select หรือ button ด้านล่างตาราง (actions)
   *
   * @param array $item
   * @return string
   */
  private function addAction($item)
  {
    if (preg_match('/^((.*)\s+)?(icon-[a-z0-9\-_]+)(\s+(.*))?$/', $item['class'], $match)) {
      $match[2] = trim($match[2].' '.(isset($match[5]) ? $match[5] : ''));
    }
    if (isset($item['href'])) {
      // links, button
      if (empty($match[3])) {
        return '<a class="'.$item['class'].'" href="'.$item['href'].'">'.$item['text'].'</a>';
      } else {
        return '<a class="'.$match[2].'" href="'.$item['href'].'"><span class="'.$match[3].'">'.$item['text'].'</span></a>';
      }
    } elseif (isset($item['options'])) {
      // select
      $rows = array();
      foreach ($item['options'] as $key => $text) {
        $rows[] = '<option value="'.$key.'">'.$text.'</option>';
      }
      return '<fieldset><select id="'.$item['id'].'">'.implode('', $rows).'</select><label for="'.$item['id'].'" class="button '.$item['class'].' action"><span>'.$item['text'].'</span></label></fieldset>';
    }
  }

  /**
   * สร้าง select ด้านบนตาราง (filters)
   *
   * @param array $item
   * @return string
   */
  private function addFilter($item)
  {
    $row = '<fieldset><label>'.$item['text'].' <select name="'.$item['name'].'">';
    foreach ($item['options'] as $key => $text) {
      $sel = (string)$key == $item['value'] ? ' selected' : '';
      $row .= '<option value="'.$key.'"'.$sel.'>'.$text.'</option>';
    }
    $row .= '</select></label></fieldset>';
    return $row;
  }
}