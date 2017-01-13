<?php
return array(
    // 网站路径
    'web_path' => '/',
    // Session配置
    'session_storage' => 'files',
    'session_ttl' => 18000000,
    // 'session_savepath' => CACHE_PATH . 'sessions/',
    'session_n' => 0,
    // Cookie配置
    'cookie_domain' => '', // Cookie 作用域
    'cookie_path' => '', // Cookie 作用路径
    'cookie_pre' => 'cndntsmjd', // Cookie 前缀，同一域名下安装多套系统时，请修改Cookie前缀
    'cookie_ttl' => 0, // Cookie 生命周期，0 表示随浏览器进程
                       // 附件相关配置
    'upload_path' => PHPFRAME_PATH . 'attms/im/',//聊天附件
    'upface_path' =>PHPFRAME_PATH . 'attms/face/',//头像
    'upatd_path' =>PHPFRAME_PATH . 'attms/atd/',//认证资料
    'upbarcode_path' =>PHPFRAME_PATH . 'attms/barcode/',//扫码
    'upload_url' => 'http://jjs.51daniu.cn/attms/', // 附件路径
    'attachment_stat' => '1', // 是否记录附件使用状态 0 统计 1 统计， 注意: 本功能会加重服务器负担

    'js_url' => 'http://jjs.51daniu.cn/attms/js/', // CDN JS
    'css_url' => 'http://jjs.51daniu.cn/attms/css/', // CDN CSS
    'img_url' => 'http://jjs.51daniu.cn/attms/images/', // CDN img
    'app_url' => 'http://jjs.51daniu.cn/m/', // 动态域名配置地址
    'www_url' => 'http://jjs.51daniu.cn/',
    'attms_url' => 'http://jjs.51daniu.cn/attms/',
    'charset' => 'utf-8', // 网站字符集
    'timezone' => 'Etc/GMT-8', // 网站时区（只对php 5.1以上版本有效），Etc/GMT-8 实际表示的是
                               // GMT+8
    'debug' => 1, // 是否显示调试信息
    'admin_log' => 1, // 是否记录后台操作日志
    'errorlog' => 1, // 1、保存错误日志到 weblogs/error | 0、在页面直接显示
    'gzip' => 1, // 是否Gzip压缩后输出
    'auth_key' => 'dnt_phpframe', // 密钥
    'lang' => 'zh-cn', // 网站语言包
    'lock_ex' => '1', // 写入缓存时是否建立文件互斥锁定（如果使用nfs建议关闭）

    'execution_sql' => 0, // EXECUTION_SQL

    'rewrite' => 0
);
//BDB--->GAI
?>
