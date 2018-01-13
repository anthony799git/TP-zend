<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Meetup\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityRepository;
use Meetup\Form\MeetupForm;
use Meetup\Filter\CustomInputFilter;
use Doctrine\ORM\EntityManager;
use Zend\Filter\DateTimeFormatter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\Meetup;





class MeetupController extends AbstractActionController
{   
    /**
     * @var EntityRepository
     */
    private $meetupRepository;
     
    /**
     * @var MeetupForm
     */
    private $meetupForm;

    /**
     * @var CustomInputFilter
     */
     private $customInputFilter;

     /**
     * @var DoctrineHydrator
     */
     private $hydrator;


    public function __construct(EntityRepository $meetupRepository, MeetupForm $meetupForm, CustomInputFilter $customInputFilter,DoctrineHydrator $hydrator)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
        $this->customInputFilter = $customInputFilter;
        $this->hydrator = $hydrator;
     
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups'  => $this->meetupRepository->findAll()
        ]);
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id');
        try {
            $meetup = $this->meetupRepository->findOneById($id);
            
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('meetups');
        }

        return new ViewModel([
            'meetup' => $meetup,
        ]);
    }

    public function newAction()
    {
        $form = $this->meetupForm;
        

         /* @var $request Request */
         $request = $this->getRequest();
         
        if($request->isPost()){
            
            $form->setInputFilter($this->customInputFilter);
            $form->setData($request->getPost());
      
            if($form->isValid()){
                $meetup = new Meetup();
                $meetup = $this->hydrator->hydrate($form->getData(),$meetup);
                $this->meetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetups');

            }
        }
        $form->prepare();
         
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        try{
            $meetup = $this->meetupRepository->findOneById($id);
            
            $form = $this->meetupForm;
            $form->bind($meetup);
             /* @var $request Request */
            $request = $this->getRequest();
            if($request->isPost()){
                $form->setInputFilter($this->customInputFilter);
              
                $form->setData($request->getPost());
                if($form->isValid()){
                    $this->meetupRepository->update($meetup);
                    return $this->redirect()->toRoute('meetups');

                }
            }
            $form->prepare();
             
            return new ViewModel([
                'form' => $form,
            ]);
            
        } 
        catch (\InvalidArgumentException $ex){
            return $this->redirect()->toRoute('meetups');
        }
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        try {
            $meetup = $this->meetupRepository->findOneById($id);
            if($meetup){
                $this->meetupRepository->remove($meetup);
                return $this->redirect()->toRoute('meetups');
            }
            
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('meetups');
        }

        
    }
}
