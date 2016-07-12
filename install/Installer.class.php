<?php
/**
 * Created by PhpStorm.
 * User: fangf
 * Date: 2016/7/10
 * Time: 10:43
 */
class Installer
{

    function checkInstalled($config_file = '../conf/config.php'){//检查是否安装过
        $config = require $config_file;
        return $config['installed'];
    }

    function saveSetting()
    {
        //填写新的配置项
        $new_config = array(
            'web'=>$_GET['web'],
            'tel'=>$_GET['tel']
        );
        echo $this->update_config($new_config)?'修改成功':'修改失败';
    }

    function update_config($new_config, $config_file = '../conf/config.php')
    {
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = array_merge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
//            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }
}