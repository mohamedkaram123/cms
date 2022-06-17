export default function SamplePrevArrow(props) {
  const { className, style, onClick } = props;
  return (
    <div
      className={className,"btn"}
      style={{ ...style}}
      onClick={onClick}
    />
  );
}
