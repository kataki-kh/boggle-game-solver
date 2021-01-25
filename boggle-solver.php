<?php
//ini_set('memory_limit', '-1');
//ini_set('max_execution_time', 30);

function check_for_word($letters_hashmap,$word){
   /// found letters
    $found_letters=0;
    ///visited cordinates
    $visited=[];
    //iterate in the word letters searching for them on the hash table
    $words_count=strlen($word);
    ///
    $stop=false;
    ///start from first letter 
    $the_temp_letter=$word[0];
    
    while($found_letters<$words_count && !$stop){
//serch for the letter on the hash table
        $the_letter=$the_temp_letter;
       
       

        if(array_key_exists($the_letter,$letters_hashmap)
           && count(array_diff(str_split($letters_hashmap[$the_letter],2),$visited))>=1
       ){
     
            //the letter is found on the hsah table
            //let us get how many times
              ///the last number was making error in the last letter to add to hash table
            $cordenates=$letters_hashmap[$the_letter];
         $cordenates = str_replace(' ', '', $cordenates);
         
           
           
           

            
            ///lets iterate throw the cordenates and check if it's available

         
                for($j=0;$j<strlen($cordenates);$j+=2){
            ///assign the first cordinates to start the search
         
                
        
               
                if($found_letters==0 && !in_array($cordenates[$j].$cordenates[$j+1],$visited)){
                $x_cord=$cordenates[$j];
                $y_cord=$cordenates[$j+1];
                array_push($visited,$x_cord.$y_cord);
                $found_letters++;
                $the_temp_letter=$word[$found_letters];
                break;
                

            }


            
            ///we are not on the first letter so we need compare the second letter cord with our cords
            else{
                
                $nexX=$cordenates[$j];
                $newY=$cordenates[$j+1];


                
 


                if(($x_cord-$newY+$y_cord-$nexX)<=1 && !in_array($j.$j+1,$visited)){
                   

                    ///the new position
                $x_cord=$cordenates[$j];
                $y_cord=$cordenates[$j+1];
                array_push($visited,$x_cord.$y_cord);

               
                
                $found_letters++;
                ///if we reached the last letter and found it then we should stop the loop
                if($found_letters==$words_count){
                    
                    $stop= true;
                    
                    break;
                    
                }
                    
                
                $the_temp_letter=$word[$found_letters];
                
                break;
                
                
                


                }else{

                    if($j==strlen($cordenates)-1){
                        $found_letters--;

                        $the_temp_letter=$word[$found_letters];
                        //
               
                        array_push($visited,$cordenates[$j].$cordenates[$j+1]);
                        $stop=true;
                        break;
                    }
           
                   
                    $the_temp_letter=$word[$found_letters];
                        //array_push($visited,$cordenates[$j].$cordenates[$j+1]);
                     
                   // break;

                       

                    
                    

                }
            }


            }
            
    
            }
                //so the letter is not found on the matrix so the word cant be formated
              else{
                $stop= true;
                
   
            }
      

    }
    
    //return $found_letters;
    if($found_letters==$words_count){
        return $found_letters;
    }else{
        return false;
    }

}
function findWords($letters_hashmap,$dictenary){
    ///notfound matrix
    $notfound=[];
    //count words
    $count=count($dictenary);
    for($i=0;$i<$count;$i++){
       $result= check_for_word($letters_hashmap,$dictenary[$i]);
      
       if($result==0){
        array_push($notfound,$dictenary[$i]);
            
       }

    }
    if(count($notfound)>0){
        return implode(",",$notfound);
        
    }else{
            return 'true';
    }
}
function  MatrixChallenge($input) 
{ 
    $M=4;
    $N=4;
    
    ///dictenary
    //$dictenary= ["all","yes","rumk","ball","mur"];//"trum", "true", "tall", "raeymnl", "mur","ball","all","yes","rumk"
    $dictenary=explode(',',$input[1]);
    ///remove space from the begging

    $dictenary=str_replace(' ', '',$dictenary);
    ///remove space from the begging
    $letters_string=str_replace(' ', '',$input[0]);

    $letters_array=explode(',',$letters_string);



    $grid=$letters_array;
    ///hashmap for letters matrix
    $letters_hashmap=array();
    
    ///loop throw the grid and make the hash map
    for($i=0;$i<$M;$i++){
        for($j=0;$j<$N;$j++){
            if(array_key_exists($grid[$i][$j],$letters_hashmap)){
    ///add cordinates to the hash table
    $cordinates= $i.$j;
    $letters_hashmap[$grid[$i][$j]].=$cordinates;
    }else{
        ///add the cordinates to the hashtable
    $array=array($grid[$i][$j]=>$i.$j);
     $letters_hashmap+=$array;
   
 }

    }

    }
  
   
 // return fmod(1,0);
///$time_start = microtime(true); 
   $result= findWords($letters_hashmap,$dictenary);
 ///  $time_end = microtime(true);
///$execution_time = ($time_end - $time_start)/60;
///echo '<b>Total Execution Time:</b> '.$execution_time.' sec    ';
    return   $result;
    
   
} 
// keep this function call here  
echo MatrixChallenge(array("aaey, rrum, tgmn, ball","ball,mur,tall"));
//a a e y
//r r u m 
//t g m n
//b a l l

///the problem here because the program was subtracting 0 and 1
//not the new cords
////$cord_diff=fmod($x_cord-$cordenates[$j],$y_cord-$cordenates[$j+1]);
///working just fine
///all,ball,mur,yes,trum,true,tall,rumk
///taking so much time =raeymnl but it work now
//ball , tall && mur
?>