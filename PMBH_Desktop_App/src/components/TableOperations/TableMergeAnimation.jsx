import React from 'react';

const TableMergeAnimation = ({ 
  sourceTable, 
  targetTable, 
  isVisible, 
  onComplete 
}) => {
  if (!isVisible || !sourceTable || !targetTable) return null;

  React.useEffect(() => {
    if (isVisible) {
      const timer = setTimeout(() => {
        onComplete && onComplete();
      }, 2000); // Animation duration
      
      return () => clearTimeout(timer);
    }
  }, [isVisible, onComplete]);

  const sourcePosition = sourceTable.position || { x: 100, y: 100 };
  const targetPosition = targetTable.position || { x: 300, y: 100 };

  return (
    <div 
      className="table-merge-animation-overlay"
      style={{
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100vw',
        height: '100vh',
        zIndex: 9999,
        pointerEvents: 'none',
        backgroundColor: 'rgba(0, 0, 0, 0.3)'
      }}
    >
      {/* Source table animation */}
      <div
        className="animate-table-source"
        style={{
          position: 'absolute',
          left: sourcePosition.x,
          top: sourcePosition.y,
          width: '80px',
          height: '60px',
          backgroundColor: '#197dd3',
          borderRadius: '8px',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          color: 'white',
          fontWeight: 'bold',
          fontSize: '12px',
          animation: 'moveToTarget 2s ease-in-out forwards',
          boxShadow: '0 4px 8px rgba(0, 0, 0, 0.3)'
        }}
      >
        {sourceTable.tenBan}
      </div>

      {/* Target table that grows */}
      <div
        className="animate-table-target"
        style={{
          position: 'absolute',
          left: targetPosition.x,
          top: targetPosition.y,
          width: '80px',
          height: '60px',
          backgroundColor: '#28a745',
          borderRadius: '8px',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          color: 'white',
          fontWeight: 'bold',
          fontSize: '12px',
          animation: 'growTable 2s ease-in-out forwards',
          animationDelay: '1s',
          boxShadow: '0 4px 8px rgba(0, 0, 0, 0.3)'
        }}
      >
        {targetTable.tenBan}
      </div>

      <style jsx>{`
        @keyframes moveToTarget {
          0% {
            transform: translate(0, 0) scale(1);
            opacity: 1;
          }
          50% {
            transform: translate(${(targetPosition.x - sourcePosition.x) / 2}px, ${(targetPosition.y - sourcePosition.y) / 2}px) scale(0.8);
            opacity: 0.8;
          }
          100% {
            transform: translate(${targetPosition.x - sourcePosition.x}px, ${targetPosition.y - sourcePosition.y}px) scale(0);
            opacity: 0;
          }
        }

        @keyframes growTable {
          0% {
            transform: scale(1);
          }
          50% {
            transform: scale(1.2);
          }
          100% {
            transform: scale(1.4);
            background-color: #28a745;
            border-radius: 12px;
          }
        }
      `}</style>
    </div>
  );
};

export default TableMergeAnimation;