<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019-11-04
 * Time: 19:43
 */

namespace Greeflas\StaticAnalyzer\Analyzer;



final class ClassStaticAnalyzer {

	public $class;

	public function __construct(\ReflectionClass $class) {
		$this->class = $class;
	}

	private function get_type():string {
		switch ($type = 'normal') {
			case $this->class->isAbstract():
				$type = 'abstract';
				break;
			case $this->class->isFinal():
				$type = 'final';
				break;
			default:
				$type = 'normal';
				break;
		}
		return $type;
	}
	public function analyze():string {

		$public_methods = count($this->class->getMethods(\ReflectionMethod::IS_PUBLIC));
		$private_methods = count($this->class->getMethods(\ReflectionMethod::IS_PRIVATE));
		$protected_methods = count($this->class->getMethods(\ReflectionMethod::IS_PROTECTED));


		$response =sprintf('Class: %s is %s
Properties:
    public: %d
    protected: %d
    private: %d
Methods:
    public: %d
    protected: %d
    private: %d',
			$this->class->getName(),
			$this->get_type(),
			$public_methods,
			$protected_methods,
			$private_methods,
			$public_methods,
			$protected_methods,
			$private_methods );
		return $response;
	}

}