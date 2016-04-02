<?php
return [
	/**
	 * SweetAlert额外参数配置
	 * 参数API详情地址：http://t4t5.github.io/sweetalert/
	 * 调用SweetAlert额外参数有两种方式
	 * 1）调用的Sweet的时候传入options,同样都为数组,例如：
	 * @param  [string]                   	$message [sweetalert内容]
	 * @param  [string]                   	$title   [sweetalert标题]
	 * @param  array                    	$options [额外参数(数组传递)]
	 * Sweet::info($type,$message,$options);
	 * Sweet::info('你好','标题',['confirmButtonText' => 'Cool'.....]);
	 * 2)在此配置文件中设置的options参数，为全局参数。
	 * 'options' => [
	 *	'confirmButtonText' => 'Cool'
	 *	....
	 *  ],
	 */
	'options' => [],
	/**
	 * 项目sweetalert.min.css路径，为空时默认为http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css
	 * 引入本地css,例：'css' => asset('sweet/sweetalert.css')
	 */
	'css' => '',
	/**
	 * 项目sweetalert.min.js路径，为空时默认为http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js
	 * 引入本地js,例：'js' => asset('sweet/sweetalert.min.js')
	 */
	'js' => '',
];