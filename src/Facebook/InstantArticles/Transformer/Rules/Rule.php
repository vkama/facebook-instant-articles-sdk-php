<?php
/**
 * Copyright (c) 2016-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */
namespace Facebook\InstantArticles\Transformer\Rules;

abstract class Rule
{
    public function matches($context, $node)
    {
        $log = \Logger::getLogger('facebook-instantarticles-transformer');

        $matches_context = $this->matchesContext($context);
        $matches_node = $this->matchesNode($node);
        return false;
    }

    abstract public function matchesContext($context);

    abstract public function matchesNode($node);

    abstract public function apply($transformer, $container, $node);

    abstract public function getContextClass();

    public static function create()
    {
        throw new Exception(
            'All Rule class extension should implement the '.
            'Rule::create() method'
        );
    }

    public static function createFrom($configuration)
    {
        throw new Exception(
            'All Rule class extension should implement the '.
            'Rule::createFrom($configuration) method'
        );
    }

    public static function retrieveProperty($array, $property_name)
    {
        if (isset($array[$property_name])) {
            return $array[$property_name];
        } elseif (isset($array['properties']) && isset($array['properties'][$property_name])) {
            return $array['properties'][$property_name];
        }
    }

    /**
     * Auxiliary method to extract full qualified class name.
     * @return string The full qualified name of class
     */
    public static function getClassName() {
        return get_called_class();
    }

}
