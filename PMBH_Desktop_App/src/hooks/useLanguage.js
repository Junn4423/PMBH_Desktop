import { useState, useEffect, useCallback } from 'react';
import languageLoader, { 
  getText, 
  getTexts, 
  getAllTexts, 
  setLanguage, 
  getCurrentLanguage,
  addLanguageChangeListener,
  removeLanguageChangeListener 
} from '../utils/languageLoader';

/**
 * React hook for using the language system
 * @param {string} module - Module name to load by default
 * @returns {Object} Language utilities and state
 */
export function useLanguage(module = null) {
  const [currentLanguage, setCurrentLanguage] = useState(() => getCurrentLanguage());
  const [isLoading, setIsLoading] = useState(false);
  const [moduleTexts, setModuleTexts] = useState(new Map());

  // Handle language changes
  useEffect(() => {
    const handleLanguageChange = (newLanguage) => {
      setCurrentLanguage(newLanguage);
      if (module) {
        loadModuleTexts();
      }
    };

    addLanguageChangeListener(handleLanguageChange);

    return () => {
      removeLanguageChangeListener(handleLanguageChange);
    };
  }, [module]);

  // Load module texts when module changes
  const loadModuleTexts = useCallback(async () => {
    if (!module) return;
    
    setIsLoading(true);
    try {
      const texts = await getAllTexts(module);
      setModuleTexts(texts);
    } catch (error) {
      console.error(`Error loading module ${module}:`, error);
    } finally {
      setIsLoading(false);
    }
  }, [module]);

  useEffect(() => {
    if (module) {
      loadModuleTexts();
    }
  }, [module, loadModuleTexts]);

  // Get single text
  const t = useCallback(async (moduleOrLine, line = null) => {
    if (typeof line === 'number') {
      // t('module', line) format
      return await getText(moduleOrLine, line);
    } else {
      // t(line) format - use default module
      if (!module) {
        throw new Error('No default module specified. Use t(module, line) format.');
      }
      return await getText(module, moduleOrLine);
    }
  }, [module]);

  // Get multiple texts
  const tMultiple = useCallback(async (moduleOrLines, lines = null) => {
    if (Array.isArray(lines)) {
      // tMultiple('module', [lines]) format
      return await getTexts(moduleOrLines, lines);
    } else {
      // tMultiple([lines]) format - use default module
      if (!module) {
        throw new Error('No default module specified. Use tMultiple(module, lines) format.');
      }
      return await getTexts(module, moduleOrLines);
    }
  }, [module]);

  // Change language
  const changeLanguage = useCallback(async (newLanguage) => {
    setIsLoading(true);
    try {
      await setLanguage(newLanguage);
    } catch (error) {
      console.error('Error changing language:', error);
    } finally {
      setIsLoading(false);
    }
  }, []);

  // Get text synchronously from loaded module (returns fallback if not loaded)
  const tSync = useCallback((line) => {
    if (!module || !moduleTexts.has(line)) {
      return `[${module || 'unknown'}.${line}]`;
    }
    return moduleTexts.get(line);
  }, [module, moduleTexts]);

  // Get all texts from loaded module
  const getAllLoadedTexts = useCallback(() => {
    return moduleTexts;
  }, [moduleTexts]);

  return {
    // State
    currentLanguage,
    isLoading,
    moduleTexts,
    
    // Functions
    t,              // Get single text (async)
    tSync,          // Get single text (sync, from loaded module)
    tMultiple,      // Get multiple texts (async)
    changeLanguage, // Change language
    getAllLoadedTexts, // Get all texts from loaded module
    
    // Utilities
    getCurrentLanguage,
    loadModuleTexts
  };
}

/**
 * Hook specifically for common texts (most frequently used)
 * @returns {Object} Common text utilities
 */
export function useCommonTexts() {
  return useLanguage('common');
}

/**
 * Hook for getting texts from multiple modules
 * @param {string[]} modules - Array of module names to load
 * @returns {Object} Multi-module text utilities
 */
export function useMultipleModules(modules = []) {
  const [currentLanguage, setCurrentLanguage] = useState(() => getCurrentLanguage());
  const [isLoading, setIsLoading] = useState(false);
  const [allModuleTexts, setAllModuleTexts] = useState(new Map());

  // Handle language changes
  useEffect(() => {
    const handleLanguageChange = (newLanguage) => {
      setCurrentLanguage(newLanguage);
      loadAllModules();
    };

    addLanguageChangeListener(handleLanguageChange);

    return () => {
      removeLanguageChangeListener(handleLanguageChange);
    };
  }, []);

  // Load all modules
  const loadAllModules = useCallback(async () => {
    if (modules.length === 0) return;

    setIsLoading(true);
    try {
      const moduleTextMap = new Map();
      
      await Promise.all(modules.map(async (module) => {
        const texts = await getAllTexts(module);
        moduleTextMap.set(module, texts);
      }));
      
      setAllModuleTexts(moduleTextMap);
    } catch (error) {
      console.error('Error loading multiple modules:', error);
    } finally {
      setIsLoading(false);
    }
  }, [modules]);

  useEffect(() => {
    loadAllModules();
  }, [modules, loadAllModules]);

  // Get text from any loaded module
  const t = useCallback((module, line) => {
    const moduleTexts = allModuleTexts.get(module);
    if (!moduleTexts || !moduleTexts.has(line)) {
      return `[${module}.${line}]`;
    }
    return moduleTexts.get(line);
  }, [allModuleTexts]);

  // Change language
  const changeLanguage = useCallback(async (newLanguage) => {
    setIsLoading(true);
    try {
      await setLanguage(newLanguage);
    } catch (error) {
      console.error('Error changing language:', error);
    } finally {
      setIsLoading(false);
    }
  }, []);

  return {
    currentLanguage,
    isLoading,
    allModuleTexts,
    t,
    changeLanguage,
    loadAllModules
  };
}