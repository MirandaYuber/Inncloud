<?php
namespace Yuber\Http\Infrastructure\ServiceLayer\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yuber\Kernel\Domain\Exceptions\BusinessLogicException;

abstract class BaseController extends Controller
{
    protected $useDbTransactions;

    protected $dbTransactions= [];

    public function useDbTransactions(bool $useDbTransactions, array $dbTransactions= []):self
    {
        $this->useDbTransactions= $useDbTransactions;
        $this->dbTransactions= $dbTransactions;

        if($this->useDbTransactions && count($this->dbTransactions) === 0){
            throw new \Exception("Especifique una o más conexiones para realizar transacción");
        }
        return $this;
    }

    public function execWithJsonResponse($callback, $fallback= null)
    {
        try{
            $this->initDbTransactions();
            $response= $callback();
            $this->commitDbTransactions();
        }catch (BusinessLogicException $exception){
            $this->rollbackDbTransactions();
            if(!is_null($fallback)) {
                $response = $fallback($exception);
            }
            else {
                $response = response()->json(['errors' => ['0' => [$exception->getMessage()]]], $exception->getCode());
            }
        }
        return $response;
    }

    public function execWithJsonSuccessResponse($callback, $fallback= null)
    {
        try{
            $this->initDbTransactions();
            $response= $callback();
            $response= array_merge([
                'success'=> true,
                'code'=> 200,
                'message'=> ''
            ], $response);

            $this->commitDbTransactions();
        }catch (ValidationException $exception){
            $this->rollbackDbTransactions();
            $errors= [];
            foreach ($exception->errors() as $field=> $error) {
                $errors[] = "$field: ".join(', ', $error).'.';
            }
            $response= response()->json([
                'success'=> false,
                'code'=> 422,
                'message'=> join( ' ', $errors)
            ],  422);

        }catch (BusinessLogicException $exception){
            $this->rollbackDbTransactions();
            $response= response()->json([
                'success'=> false,
                'code'=> $exception->getCode(),
                'message'=> $exception->getMessage()
            ], $exception->getCode());
        }catch (\Exception $exception){
            $this->rollbackDbTransactions();
            $response= response()->json([
                'success'=> false,
                'code'=> 400,
                'message'=> $exception->getMessage()
            ], 400);
        }
        return $response;
    }

    public function execWithHttpResponse($callback)
    {
        try{
            $this->initDbTransactions();
            $response= $callback();
            $this->commitDbTransactions();
        }catch (BusinessLogicException $exception){
            $this->rollbackDbTransactions();
            return back()->withErrors($exception->getMessage());
        }
        return $response;
    }

    public function execWithRawResponse($callback, $fallback)
    {
        try{
            $this->initDbTransactions();
            $response= $callback();
            $this->commitDbTransactions();
        }catch (BusinessLogicException $exception){
            $this->rollbackDbTransactions();
            $response= $fallback($exception);
        }
        return $response;
    }


    protected function initDbTransactions():self
    {
        if($this->useDbTransactions){
            foreach ($this->dbTransactions as $dbTransaction){
                DB::connection($dbTransaction)->beginTransaction();
            }
        }
        return $this;
    }

    protected function rollbackDbTransactions():self
    {
        foreach ($this->dbTransactions as $dbTransaction){
            DB::connection($dbTransaction)->rollBack();
        }
        return $this;
    }

    protected function commitDbTransactions():self
    {
        foreach ($this->dbTransactions as $dbTransaction){
            DB::connection($dbTransaction)->commit();
        }
        return $this;
    }
}

