<?php

	require_once 'Color.class.php';

	class Vector
	{
		static $verbose = FALSE;
		private $_x = 0.0;
		private $_y = 0.0;
		private $_z = 0.0;
		private $_w = 0.0;
		public function __construct(array $coord)
		{
			if (array_key_exists('dest', $coord))
			{
				if (array_key_exists('orig', $coord))
				{
					$this->_x = floatval($coord['dest']->_x - $coord['orig']->_x);
					$this->_y = floatval($coord['dest']->_y - $coord['orig']->_y);
					$this->_z = floatval($coord['dest']->_z - $coord['orig']->_z);
				}
				else
				{
					$orig = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
					$this->_x = floatval($coord['dest']->_x) - $orig->_x ;
					$this->_y = floatval($coord['dest']->_y) - $orig->_y ;
					$this->_z = floatval($coord['dest']->_z) - $orig->_z ;
				}
			}
			if (Vector::$verbose === TRUE){
				printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed\n",
					$this->_x, $this->_y, $this->_z, $this->_w);
			}
		}
		public function __destruct() {
			if (Vector::$verbose === TRUE)
				printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n",
					$this->_x, $this->_y, $this->_z, $this->_w);
		}
		public function __get($property) {
			return $this->$property;
		}
		public function __toString() {
			return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x,
				$this->_y, $this->_z, $this->_w);
		}
		public function doc() {
			return file_get_contents("Vector.doc.txt");
		}
		public function magnitude() {
			return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
		}
		public function normalize() {
			$len = $this->magnitude();
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_x / $len, 'y' => $this->_y / $len,
					'z' => $this->_z / $len ))) );
		}
		public function add(Vector $rhs) {
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_x + $rhs->_x, 'y' => $this->_y + $rhs->_y,
					'z' => $this->_z + $rhs->_z))) );
		}
		public function sub(Vector $rhs) {
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_x - $rhs->_x, 'y' => $this->_y - $rhs->_y,
					'z' => $this->_z - $rhs->_z))) );
		}
		public function opposite() {
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_x * -1, 'y' => $this->_y * -1,
					'z' => $this->_z * -1))) );
		}
		public function scalarProduct($k) {
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_x * $k, 'y' => $this->_y * $k,
					'z' => $this->_z * $k))) );
		}
		public function dotProduct(Vector $rhs){
			return $this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z;
		}
		public function cos(Vector $rhs){
			return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
		}
		public function crossProduct(Vector $rhs) {
			return new Vector( array('dest' => new Vertex(
				array( 'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
					'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
					'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x ) ) ) );
		}
	}


?>