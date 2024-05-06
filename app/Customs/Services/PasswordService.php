<?php
namespace App\Customs\Services;

use Illuminate\Support\Facades\Hash;

try {
    class PasswordService{
        private function validateCurrentPassword($current_password){
            // $user1=auth()->user();
            // if (!$user1) {
            //     response()->json([
            //         'status' => 'failed',
            //         'message' => 'User could not be found,Please login.'
            //       ])->send();
            //       exit;
            //     }
            if(!password_verify($current_password,auth()->user()->password)){
                 response()->json([
                    'status'=>'failed',
                    'message'=>'The password did not match the current password'])->send();
                    exit;
            }

        }
        public function changePassword($data){
            $this->validateCurrentPassword($data['current_password']);
            $updatePassword=auth()->user()->update([
                'password'=>Hash::make($data['password'])
            ]);
            if($updatePassword){
                return response() ->json([
                    'status'=>'success',
                    'message'=>'Password Updated Successfully.'
                ]);
            }
            else{
                return response() ->json([
                    'status'=>'failed',
                    'message'=>'An erorr occured while updating password.'
                ]);

                }

        }

    }
  } catch (AccessDeniedHttpException $e) {
    $errorMessage = $e->getMessage(); // Get the error message
    return response()->json([
      'status' => 'failed',
      'message' => $errorMessage
    ])->setStatusCode(403);  // Set appropriate status code (unauthorized)
  }
