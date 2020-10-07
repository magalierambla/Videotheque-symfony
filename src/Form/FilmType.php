<?php
namespace App\Form;

use App\Entity\Film;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
      
      
        
        
        $builder->add('title', TextType::class, ['required' => true], [
            'attr' => [              
                'class' => 'form-control',              
            ]
        ]);      

        $builder->add('resume', TextareaType::class, ['required' => false,'data_class' => null], [
            'attr' => [              
                'class' => 'form-control',              
            ]
        ]);

        $builder->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'label',
            'multiple' => true,
            'expanded' => false,
            'required' => true,           
        ]);

        $builder->add('picture', FileType::class, ['required' => false,'data_class' => null],[
            'attr' => [              
                'class' => 'form-control',              
            ]
        ]);

       

                
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}

?>