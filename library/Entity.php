<?php

  namespace Library;

  abstract class Entity {

    private $id;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return (int) $this->id;
    }

    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $fields = explode('_', $key);
            $method = 'set'.ucfirst($fields[0]);
            if (isset($fields[1])) $method.= ucfirst($fields[1]); 
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
  }
