<?php

    class Matrix {
        const   IDENTITY = "IDENTITY";
        const   SCALE = 'SCALE';
        const   RX = 'RX';
        const   RY = 'RY';
        const   RZ = 'RZ';
        const   TRANSLATION = 'TRANSLATION';
        const   PROJECTION = 'PROJECTION';
        static $verbose = false;
        protected $_matrix;
        public function __construct(array $input)
        {
            if ($input['preset'] === Matrix::IDENTITY)
            {
                $this->_matrix = array(
                    array(1.0, 0.0, 0.0, 0.0),
                    array(0.0, 1.0, 0.0, 0.0),
                    array(0.0, 0.0, 1.0, 0.0),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::SCALE)
            {
                $this->_matrix = array(
                    array($input['scale'], 0.0, 0.0, 0.0),
                    array(0.0, $input['scale'], 0.0, 0.0),
                    array(0.0, 0.0, $input['scale'], 0.0),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::RX)
            {
                $this->_matrix = array(
                    array(1, 0.0, 0.0, 0.0),
                    array(0.0, cos($input['angle']), -sin($input['angle']), 0.0),
                    array(0.0, sin($input['angle']), cos($input['angle']), 0.0),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::RY)
            {
                $this->_matrix = array(
                    array(cos($input['angle']), 0.0, sin($input['angle']), 0.0),
                    array(0.0, 1.0, 0.0, 0.0),
                    array(-sin($input['angle']), 0.0, cos($input['angle']), 0.0),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::RZ)
            {
                $this->_matrix = array(
                    array(cos($input['angle']), -sin($input['angle']), 0.0, 0.0),
                    array(sin($input['angle']), cos($input['angle']), 0.0, 0.0),
                    array(0.0, 0.0, 1.0, 0.0),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::TRANSLATION)
            {
                $this->_matrix = array(
                    array(1.0, 0.0, 0.0, $input['vtc']->_x),
                    array(0.0, 1.0, 0.0, $input['vtc']->_y),
                    array(0.0, 0.0, 1.0, $input['vtc']->_z),
                    array(0.0, 0.0, 0.0, 1.0),
                );
            }
            else if ($input['preset'] === Matrix::PROJECTION)
            {
                $fov = doubleval($input['fov']);
                $ratio = doubleval($input['ratio']);
                $near = doubleval($input['near']);
                $far = doubleval($input['far']);
                $scale = tan($fov * 0.5 * pi() / 180) * $near;
                $r = $ratio * $scale;
                $l = -$r;
                $this->_matrix = array (
                    array ( (2 * $near) / ($r -$l), 0, 0, 0),
                    array ( 0, (2 * $near) / (2 * $scale), 0, 0),
                    array ( 0, 0, -(($far + $near) / ($far - $near)), -((2 * $far * $near) / ($far - $near) ) ),
                    array ( 0, 0, -1, 0) );
                }
                if (Matrix::$verbose === true)
                    printf("Matrix %s instance constructed\n", $input['preset']);
        }
        public function __destruct()
        {
            if (Matrix::$verbose === true)
                printf("Matrix instance destructed\n");
        }

        public function __toString()
        {
            return sprintf("M | vtcX | vtcY | vtcZ | vtxO
-----------------------------
x | %.2f | %.2f | %.2f | %.2f
y | %.2f | %.2f | %.2f | %.2f
z | %.2f | %.2f | %.2f | %.2f
w | %.2f | %.2f | %.2f | %.2f",
                $this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
                $this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
                $this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
                $this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]);
        }
        public function doc()
        {
            return file_get_contents("Matrix.doc.txt");
        }
        public function mult(Matrix $rhs)
        {
            return $rhs;
        }
        public function transformVertex(Vertex $vtx)
        {
            return new Vertex( array(
                'x' => $vtx->_x * $this->_matrix[0][0] + $vtx->_y * $this->_matrix[0][1] + $vtx->_z * $this->_matrix[0][2] + $this->_matrix[0][3],
                'y' => $vtx->_x * $this->_matrix[1][0] + $vtx->_y * $this->_matrix[1][1] + $vtx->_z * $this->_matrix[1][2] + $this->_matrix[1][3],
                'z' => $vtx->_x * $this->_matrix[2][0] + $vtx->_y * $this->_matrix[2][1] + $vtx->_z * $this->_matrix[2][2] + $this->_matrix[2][3]
            ));


        }
    }

?>