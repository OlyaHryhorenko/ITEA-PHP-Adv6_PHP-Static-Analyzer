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

		$public_properties_count = count($this->class->getProperties(\ReflectionMethod::IS_PUBLIC));
		$private_properties_count = count($this->class->getProperties(\ReflectionMethod::IS_PRIVATE));
		$protected_properties_count = count($this->class->getProperties(\ReflectionMethod::IS_PROTECTED));
		$public_methods_count = count($this->class->getMethods(\ReflectionMethod::IS_PUBLIC));
		$private_methods_count = count($this->class->getMethods(\ReflectionMethod::IS_PRIVATE));
		$protected_methods_count = count($this->class->getMethods(\ReflectionMethod::IS_PROTECTED));


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
			$public_properties_count,
			$protected_properties_count,
			$private_properties_count,
			$public_methods_count,
			$protected_methods_count,
			$private_methods_count );
		return $response;
	}

}