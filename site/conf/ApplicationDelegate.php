<?php
class conf_ApplicationDelegate {
   function getPermissions(&$record){
	$perms= datagrillhelper::getuserpermissions();
	return $perms;	
   }


}
