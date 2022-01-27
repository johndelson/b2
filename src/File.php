<?php

namespace johndelson\B2;

class File
{
    protected $id;
    protected $name;
    protected $versions;
    protected $hash;
    protected $size;
    protected $type;
    protected $info;
    protected $bucketId;
    protected $action;
    protected $uploadTimestamp;

    /**
     * File constructor.
     *
     * @param array $args
     */
    public function __construct($args)
    {
        if (isset($args['fileName']) && strpos($args['fileName'], '/')) {
            $args['fileInfo'] = array_merge(pathinfo($args['fileName']), $args['fileInfo']);
        }
        $this->id = $args['fileId'] ?? null;
        $this->name = $args['fileName'] ?? null;
        $this->uploadTimestamp = isset($args['uploadTimestamp']) ? $args['uploadTimestamp'] / 1000 : null;
        $this->info = $args['fileInfo'] ?? null;
        $this->size = $args['size'] ?? null;

        if (!isset($args['version'])) {
            $this->versions = [];
            $this->hash = $args['contentSha1'] ?? null;            
            $this->type = $args['contentType'] ?? null;            
            $this->bucketId = $args['bucketId'] ?? null;
            $this->action = $args['action'] ?? null;
        }
        
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @return string
     */
    public function setVersions(array $file)
    {
        $file['version'] = $file['uploadTimestamp'];
        $this->versions[$file['version']] = new File($file);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getBucketId()
    {
        return $this->bucketId;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getUploadTimestamp()
    {
        return $this->uploadTimestamp;
    }
}
