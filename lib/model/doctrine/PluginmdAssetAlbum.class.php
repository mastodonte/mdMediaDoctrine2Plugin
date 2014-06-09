<?php

/**
 * PluginmdAssetAlbum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginmdAssetAlbum extends BasemdAssetAlbum
{

  public function getAvatar(){
    return mdAssetFileTable::getInstance()->findOneById($this->getMdAssetFileId());
  }

  public function hasAvatar()
  {
    return !is_null($this->getMdAssetFileId()) && $this->getMdAssetFileId() != '';
  }
  
  public function getAvatarFilename(){
    if($this->hasAvatar()){
      return $this->getRelativePath() . '/' . $this->getAvatar()->getFilename();
    }else{
      return false;
    }
  }

  public static function create($object, $name = 'Default', $description = ''){
    $base_dir = $object->getBaseDir();
    $object_dir = $object->getObjectDir();
    $relative_path = $base_dir . '/' . $object_dir;
    
    $mdAssetAlbum = new mdAssetAlbum();
    $mdAssetAlbum->setName($name);
    $mdAssetAlbum->setObjectId($object->getId());
    $mdAssetAlbum->setObjectClass($object->getObjectClass());
    $mdAssetAlbum->setRelativePath($relative_path);
    $mdAssetAlbum->setDescription($description);
    $mdAssetAlbum->save();
    
    return $mdAssetAlbum;
  } 

  public function getObject(){
    return Doctrine::getTable($this->getObjectClass())->find($this->getObjectId());
  }

  public function getYouTube()
  {
    return mdAssetYoutubeTable::getInstance()->getVideoByAlbum($this->getId());
  }

}