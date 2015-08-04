<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

class nexus{

    function debug($object){

        $title = (func_num_args() == 2) ? func_get_arg(1) : 'Debug';

        if(is_array($object) && func_num_args() == 1){
            $title = "Debugging Array(".sizeof($object).")";
        }
        print "<details class=debug open>";
        print "<summary>'.$title.'</summary>";
        print "<pre>";
        print_r($object);
        print "</pre>";
        print "</details>";
    }

    function get_name(){
        $name = get_class($this);
        $name = "nexus";
        $name = str_replace('nexus_','',$name);
        $name = str_replace('_',' ',$name);
        $name = ucwords($name);
        return $name;
    }

    function get_module_path($param=[]){

        $param['relative'] = array_key_exists('relative',$param) ? $param['relative'] : true;

        $reflector = new ReflectionClass(get_class($this));
        $fn = $reflector->getFileName();
        $path = dirname($fn);

        $path = ($param['relative'] === true) ? str_replace($_SERVER['DOCUMENT_ROOT'],'',$path) : $path;

        return $path;
    }

    function get_template($filename){

        $template = file_get_contents("../../templates/".$filename);

        /*
			if(file_exists($param['filename'])){
				$param['filename'] = $param['filename'];
			}
			else if(file_exists(self::get_module_path(['relative'=>false]).'/'.$param['filename'])){
				$param['filename'] = self::get_module_path(['relative'=>false]).'/'.$param['filename'];
			}
			else if(file_exists('templates/'.$param['filename'])){
				$param['filename'] = 'templates/'.$param['filename'];
			}
			else{
				$parent = get_parent_class($this);
				$parent = new $parent();
				if(file_exists($parent->get_module_path().'/'.$param['filename'])){

					$param['filename'] = $parent->get_module_path().'/'.$param['filename'];
				}
				else if(file_exists($parent->get_module_path(['relative'=>false]).'/'.$param['filename'])){
					$param['filename'] = $parent->get_module_path(['relative'=>false]).'/'.$param['filename'];
				}
			}

			if(!file_exists($param['filename'])){$this->error('Could not find file '.$param['filename']); return null;}

			$template = file_get_contents($param['filename']);

			$param['data'] 				= array_key_exists('data',$param) ? $param['data'] : [];
			$param['data']['method'] 	= array_key_exists('method',$param['data']) ? $param['data']['method'] : (debug_backtrace()[1]['function'] ?: null);
			$param['data']['class_name'] = $param['data']['class_name'] ?: get_class($this);

			return self::parse_template($template,$param['data']);
            */
            return $template;
    }

    function parse_template($template,$data){

            //these are gonna be the global variables
			//these values must get fetched from the setup file\module

            //$template = file_get_contents(getcwd()."/core/templates/".$template);
            $template = $this->get_template($template);

            $data['company_name']                        = "Domestic"; //settings //company settings
            $data['company_logo']                        = "/images/company_logo.png";
			$data['year']                                = date('Y');
			$data['month']                               = intval(getdate()['mon']) < 10 ? ('0'.getdate()['mon']) : getdate()['mon'];
			$data['day']                                 = getdate()['mday'];
			$data['weekday']                             = getdate()['weekday'];
			$data['today']                               = $data['year'].'-'.$data['month'].'-'.$data['day'];

			$data['class']															= get_class($this);

			while(preg_match("/\(#(.*?)#\)/", $template)){
				if (preg_match_all("/\(#(.*?)#\)/", $template, $variables)){

					foreach ($variables[1] as $i => $variable_name){
                        $match		= array_key_exists($variable_name,$data) ? $data[$variable_name] : "(!#".$variable_name."#!)";
						$match		= is_array($match) ? json_encode($match) : $match;
						$template	= str_replace($variables[0][$i],$match, $template);
					}
				}
			}

			return $template;
		}


    function __construct($param=array()){

        $user = UserService::getCurrentUser();
        if (!$user){
            header("Location: https://accounts.google.com/Login#identifier");
        }
        /*
        $this->name = $this->get_name();

        $param = is_array($param) ? $param : [];
        $param = array_merge($param,$_GET);

        $param['method'] = array_key_exists('method',$param) ? $param['method'] : null;

        if($param['method']){
            if(method_exists($this,$param['method'])){
                $_GET['method'] = null;
                $this->$param['method']();
            }
            else{
                $this->error('Method: '.$param['method'].' does not exist in '.get_class($this).'.php');
            }
        }
        */
        $content    = $this->get_template('dashboard.template');

        $name       = $this->get_name();

        echo $this->parse_template("index.template",[
            "title"     => $name,
            "head"      => $this->get_template("head.template"),
            "content"   => $content
        ]);
    }
}

?>

<?php
    new nexus();
?>
