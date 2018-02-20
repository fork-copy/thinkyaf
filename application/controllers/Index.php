<?php
/**
 * Date: 2018\2\20 0020 14:15
 */

class IndexController extends Controller
{

    public function IndexAction()
    {
      $user =   new UserModel();
      $user->listsShow();
    }
}