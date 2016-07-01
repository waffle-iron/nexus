<?php

/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace AppEngine;

use Symfony\Component\Debug\Debug;

final class Environment
{
    public static function onAppEngine()
    {
        return isset($_SERVER['SERVER_SOFTWARE'])
            && 0 === strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine');
    }

    public static function onDevAppServer()
    {
        return isset($_SERVER['SERVER_SOFTWARE'])
            && 0 === strpos($_SERVER['SERVER_SOFTWARE'], 'Development/');
    }

    public static function doAppEngineCheck()
    {
        if (Environment::onDevAppServer()) {
            // turn on error reporting and debugging
            Debug::enable(E_ERROR | E_PARSE);

            // fix Dev AppServer XML-loading bug
            Environment::fixXmlFileLoaderBug();
        }

        if (self::onAppEngine() || self::onDevAppServer()) {
            // self::checkBucketName();
        }
    }

    /**
     * Prevents "Unable to parse file" error thrown on core XML validation.
     *
     * This is only required when running symfony on Dev AppServer. We fix it by including a new
     * class file for XmlFileLoader
     *
     * @see http://stackoverflow.com/questions/32352739
     */
    public static function fixXmlFileLoaderBug()
    {
        $xmlFileLoaderPath = array(
            __DIR__,
            'data',
            'XmlFileLoader.php'
        );

        require_once implode(DIRECTORY_SEPARATOR, $xmlFileLoaderPath);
    }

    public static function checkBucketName()
    {
        $bucketNameFromEnv = getenv('nexus-ga-default-bucket');
        if (empty($bucketNameFromEnv) || $bucketNameFromEnv == 'nexus-ga-default-bucket') {
            throw new \Exception(
                'You must set the environment variable "GCS_BUCKET_NAME" when using App Engine.'
                . ' This can be done using "environment_variables" in app.yaml'
            );
        }

        $bucketNameFromIni = ini_get('google_app_engine.allow_include_gs_buckets');
        if (empty($bucketNameFromIni) || $bucketNameFromIni == 'nexus-ga-default-bucket') {
            throw new \Exception(
                'You must set "google_app_engine.allow_include_gs_buckets" to your GCS bucket'
                . ' name in php.ini'
            );
        }

        if ($bucketNameFromEnv !== $bucketNameFromIni) {
            throw new \Exception(
                sprintf(
                    'bucket name from ini (%s) does not match bucket name from env (%s)',
                    $bucketNameFromIni,
                    $bucketNameFromEnv
                )
            );
        }
    }

    public static function clearCache($dir)
    {
        foreach (glob($dir . '/*') as $path) {
            if (is_dir($path)) {
                self::clearCache($path);
            } else {
                unlink($path);
            }
        }
        @rmdir($dir);
    }
}