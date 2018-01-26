<?php

namespace LaravelEnso\Core\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Core\app\Models\Preference;
use LaravelEnso\Core\app\Classes\DefaultPreferences;

class PreferencesController extends Controller //fixme. We need dedicated controllers for global / local
{
    public function setPreferences($route = null)
    {
        return $route
        ? $this->setLocalPreferences($route)
        : $this->setGlobalPreferences();
    }

    public function resetToDefault($route = null)
    {
        return $route
        ? $this->resetLocalPreferences($route)
        : $this->resetGlobalPreferences();
    }

    private function setGlobalPreferences()
    {
        if (!request()->user()->preference) {
            request()->user()->preference()->save($this->getDefaultPreference());
        }

        $this->updateGlobalPreference(request()->get('global'));
    }

    private function setLocalPreferences($route)
    {
        if (!request()->user()->preference) {
            request()->user()->preference()->save($this->getDefaultPreference());
        }

        $this->updateLocalPreference($route, $this->request->all());
    }

    private function resetGlobalPreferences()
    {
        if (!request()->user()->preference) {
            return request()->user()->preference()->save($this->getDefaultPreference());
        }

        $this->updateGlobalPreference($this->getGlobalPreferences());
    }

    private function resetLocalPreferences($route)
    {
        $this->setPreference();
        $this->preference->value->local->$route = (new DefaultPreferences())->getData()->local->$route;
        $this->updatePreference();
    }

    private function getGlobalPreferences()
    {
        return json_decode($this->getDefaultPreference())->value->global;
    }

    private function getDefaultPreference()
    {
        return new Preference(['value' => (new DefaultPreferences())->getData()]);
    }

    private function updateGlobalPreference($preferences)
    {
        foreach ($preferences as $key => $value) {
            request()->user()->preference()->update(['value->global->'.$key => $value]);
        }
    }

    private function updateLocalPreference($route, $preferences)
    {
        foreach ($preferences as $key => $value) {
            if (is_array($value) && count($value) === 1) {
                return $this->updateLocalPreference($route.'->'.$key, $value);
            }

            request()->user()->preference()->update(['value->local->'.$route.'->'.$key => json_encode($value)]);
        }
    }
}
