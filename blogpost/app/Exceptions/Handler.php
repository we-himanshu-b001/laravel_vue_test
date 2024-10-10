<?php

namespace App\Exceptions;

use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * @param Throwable $exception
     * @return mixed|void
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response|JsonResponse|RedirectResponse|Redirector
     * @throws Throwable
     * @noinspection PhpMissingParamTypeInspection
     */
    public function render($request, Throwable $exception)
    {
        if($request->expectsJson())
        {
            if($exception instanceof ModelNotFoundException)
                return new JsonResponse([
                    'message' => "Unable to locate the {$this->prettyModelNotFound($exception)} data you requested."
                ], 404);
        }

        if($exception instanceof ModelNotFoundException)
            throw new NotFoundHttpException("Unable to locate the {$this->prettyModelNotFound($exception)} data you requested.");

        return parent::render($request, $exception);
    }

    /**
     * @param Throwable $exception
     * @return string
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    private function prettyModelNotFound(Throwable $exception)
    {
        try {
            // Get the fully qualified model class name from the exception
            $modelClass = $exception->getModel();

            // Use ReflectionClass to get the short name of the model
            $shortName = (new ReflectionClass($modelClass))->getShortName();

            // Convert CamelCase to spaced lowercase words
            return Str::lower(preg_replace('/(?<!^)(?=[A-Z])/', ' ', $shortName));
        } catch (ReflectionException $e) {
            report($e); // Log the exception for debugging
        } catch (\Exception $e) {
            report($e); // Catch any other exceptions that might occur
        }
        return 'resource';
    }
}
