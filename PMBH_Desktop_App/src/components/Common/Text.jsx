import React, { useState, useEffect } from 'react';
import { getText, getTexts } from '../../utils/languageLoader';
import { useLanguageContext } from '../../contexts/LanguageContext';

/**
 * Text component for displaying internationalized text
 * Usage examples:
 * <Text module="common" line={1} />
 * <Text module="sales" line={5} fallback="Default text" />
 * <Text module="auth" line={2} loading="..." />
 */
export function Text({ 
  module, 
  line, 
  fallback = null, 
  loading = '...', 
  className = '', 
  style = {},
  as: Component = 'span',
  ...props 
}) {
  const [text, setText] = useState(fallback || `[${module}.${line}]`);
  const [isLoading, setIsLoading] = useState(true);
  const { currentLanguage } = useLanguageContext();

  useEffect(() => {
    let isMounted = true;
    
    const loadText = async () => {
      if (!module || !line) {
        setText(fallback || '');
        setIsLoading(false);
        return;
      }

      setIsLoading(true);
      
      try {
        const loadedText = await getText(module, line);
        
        if (isMounted) {
          setText(loadedText);
          setIsLoading(false);
        }
      } catch (error) {
        console.error(`Error loading text ${module}.${line}:`, error);
        
        if (isMounted) {
          setText(fallback || `[${module}.${line}]`);
          setIsLoading(false);
        }
      }
    };

    loadText();

    return () => {
      isMounted = false;
    };
  }, [module, line, currentLanguage, fallback]);

  const displayText = isLoading ? loading : text;

  return (
    <Component 
      className={className} 
      style={style}
      {...props}
    >
      {displayText}
    </Component>
  );
}

/**
 * Hook for using text with loading state
 * @param {string} module - Module name
 * @param {number} line - Line number
 * @param {string} fallback - Fallback text
 * @returns {Object} {text, isLoading}
 */
export function useText(module, line, fallback = null) {
  const [text, setText] = useState(fallback || `[${module}.${line}]`);
  const [isLoading, setIsLoading] = useState(true);
  const { currentLanguage } = useLanguageContext();

  useEffect(() => {
    let isMounted = true;
    
    const loadText = async () => {
      if (!module || !line) {
        setText(fallback || '');
        setIsLoading(false);
        return;
      }

      setIsLoading(true);
      
      try {
        const loadedText = await getText(module, line);
        
        if (isMounted) {
          setText(loadedText);
          setIsLoading(false);
        }
      } catch (error) {
        console.error(`Error loading text ${module}.${line}:`, error);
        
        if (isMounted) {
          setText(fallback || `[${module}.${line}]`);
          setIsLoading(false);
        }
      }
    };

    loadText();

    return () => {
      isMounted = false;
    };
  }, [module, line, currentLanguage, fallback]);

  return { text, isLoading };
}

/**
 * Hook for using multiple texts
 * @param {string} module - Module name
 * @param {number[]} lines - Array of line numbers
 * @returns {Object} {texts, isLoading}
 */
export function useTexts(module, lines) {
  const [texts, setTexts] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const { currentLanguage } = useLanguageContext();

  useEffect(() => {
    let isMounted = true;
    
    const loadTexts = async () => {
      if (!module || !Array.isArray(lines) || lines.length === 0) {
        setTexts([]);
        setIsLoading(false);
        return;
      }

      setIsLoading(true);
      
      try {
        const loadedTexts = await getTexts(module, lines);
        
        if (isMounted) {
          setTexts(loadedTexts);
          setIsLoading(false);
        }
      } catch (error) {
        console.error(`Error loading texts ${module}.${lines.join(',')}:`, error);
        
        if (isMounted) {
          setTexts(lines.map(line => `[${module}.${line}]`));
          setIsLoading(false);
        }
      }
    };

    loadTexts();

    return () => {
      isMounted = false;
    };
  }, [module, JSON.stringify(lines), currentLanguage]);

  return { texts, isLoading };
}

/**
 * Higher-order component to inject text props
 * @param {React.Component} WrappedComponent 
 * @param {Object} textConfig - Configuration for texts to load
 * @returns {React.Component} Enhanced component with text props
 */
export function withTexts(WrappedComponent, textConfig = {}) {
  return function TextEnhancedComponent(props) {
    const { currentLanguage } = useLanguageContext();
    const [texts, setTexts] = useState({});
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
      const loadAllTexts = async () => {
        setIsLoading(true);
        const textResults = {};
        
        try {
          await Promise.all(
            Object.entries(textConfig).map(async ([key, { module, line }]) => {
              const text = await getText(module, line);
              textResults[key] = text;
            })
          );
          
          setTexts(textResults);
        } catch (error) {
          console.error('Error loading texts:', error);
        } finally {
          setIsLoading(false);
        }
      };

      loadAllTexts();
    }, [currentLanguage]);

    return (
      <WrappedComponent
        {...props}
        texts={texts}
        textsLoading={isLoading}
      />
    );
  };
}

export default Text;