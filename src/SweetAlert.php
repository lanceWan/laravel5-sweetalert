<?php
namespace Lance\Sweet;
use Illuminate\Session\SessionManager;
use Illuminate\Config\Repository;
/**
* 创建SweetAlert.js类
*/
class SweetAlert
{
	// SessionManager
	protected $session;
	// Repository
	protected $config;

	protected $css;

	protected $js;
	//conf文件中未定义css路径时使用CDN
	protected $cssCND = 'http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css';
	//conf文件中未定义js路径时使用CDN
	protected $jsCND = 'http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js';
	/**
	 * 存储session中的值
	 * @var array
	 */
	protected $notifications = [];
	/**
	 * 实例化
	 * @author 晚黎
	 * @date   2016-04-02T09:28:59+0800
	 * @param  SessionManager           $session [description]
	 * @param  Repository               $config  [description]
	 */
	function __construct(SessionManager $session,Repository $config)
	{
		$this->session = $session;
		$this->config = $config;
	}

	/**
	 * 获取sweetAlert.js视图
	 * @author 晚黎
	 * @date   2016-04-02T09:34:45+0800
	 * @return [type]                   [description]
	 */
	public function render()
	{

		$notifications = $this->session->get('sweet:notifications');
		if (!$notifications) {
			return '';
		}

		$css = $this->config->get('sweet.css');
		$js = $this->config->get('sweet.js');

		$css = $css ? $css:$this->cssCND;
		$js = $js ? $js:$this->jsCND;

		$javascript = '';

		foreach ($notifications as $notification) {
			$config = $this->config->get('sweet.options');
			// dd($config);
			
			if($config) {
                $notification = array_unique(array_merge($config, $notification));
            }

            if ($notification) {
            	$javascript = 'swal('.json_encode($notification).');';
            }
            
		}
		$this->clear();
		return view('Sweet::sweet', compact('javascript','css','js'));
	}

	/**
	 * 创建一次性session
	 * @author 晚黎
	 * @date   2016-04-02T09:46:05+0800
	 * @param  [type]                   $type    [sweetalert弹出框类型]
	 * @param  [type]                   $message [sweetalert内容]
	 * @param  [type]                   $title   [sweetalert标题]
	 * @param  array                    $options [其他额外配置]
	 */
	public function create($type,$message,$title='',$options=[])
	{
		$types = ['info', 'warning', 'success', 'error'];

		if(!in_array($type, $types)) {
            return false;
        }
        $this->notifications[] = [
            'type' => $type,
            'title' => $title,
            'text' => $message
        ];
        if ($options) {
        	$this->notifications = array_unique(array_merge($options,$this->notifications));
        }
        $this->session->flash('sweet:notifications', $this->notifications);
	}

	/**
	 * 提示弹出框
	 * @author 晚黎
	 * @date   2016-04-02T09:49:36+0800
	 * @param  [type]                   $message [sweetalert内容]
	 * @param  [type]                   $title   [sweetalert标题]
	 * @param  array                    $options [其他额外配置]
	 */
	public function info($message,$title='',$options=[])
	{
		$this->create('info',$message,$title,$options);
	}

	/**
	 * 警告弹出框
	 * @author 晚黎
	 * @date   2016-04-02T09:49:36+0800
	 * @param  [type]                   $message [sweetalert内容]
	 * @param  [type]                   $title   [sweetalert标题]
	 * @param  array                    $options [其他额外配置]
	 */
	public function warning($message,$title='',$options=[])
	{
		$this->create('warning',$message,$title,$options);
	}


	/**
	 * 成功弹出框
	 * @author 晚黎
	 * @date   2016-04-02T09:49:36+0800
	 * @param  [type]                   $message [sweetalert内容]
	 * @param  [type]                   $title   [sweetalert标题]
	 * @param  array                    $options [其他额外配置]
	 */
	public function success($message,$title='',$options=[])
	{
		$this->create('success',$message,$title,$options);
	}


	/**
	 * 错误弹出框
	 * @author 晚黎
	 * @date   2016-04-02T09:49:36+0800
	 * @param  [type]                   $message [sweetalert内容]
	 * @param  [type]                   $title   [sweetalert标题]
	 * @param  array                    $options [其他额外配置]
	 */
	public function error($message,$title='',$options=[])
	{
		$this->create('error',$message,$title,$options);
	}

	/**
     * Clear notifications
     */
    public function clear()
    {
        $this->notifications = [];
    }
}